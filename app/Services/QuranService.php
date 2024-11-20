<?php
namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class QuranService
{
    protected $configs = [];
    protected Collection $suwar;
    protected Collection $reciters;
    public function __construct()
    {
        $this->configs = config('services.quran');
        $this->suwar = $this->get('suwar');
        $this->reciters = $this->get('reciters');
    }
    public function getSuwar(): Collection
    {
        return $this->suwar;
    }
    public function getReciters(): Collection
    {
        return $this->reciters;
    }

    /**
     * Fetches data from the Quran API.
     *
     * @param string $endpoint The endpoint to fetch data from.
     * @return \Illuminate\Support\Collection
     */
    private function get(string $endpoint)
    {
        $url = $this->configs['base_url'];
        $url = $url . '/' . $endpoint;
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get($url);
        if ($response->successful() && $response->json()) {
            return Cache::remember($endpoint, now()->addMonth(), function () use ($endpoint, $response) {
                return new Collection($response->json()[$endpoint]);
            });
        }
        return new Collection([]);
    }


    public function findReciterReaway($id, $rewaya)
    {
        $reciter = $this->reciters->where('id', $id)->first();
        foreach ($reciter['moshaf'] as $moshaf) {
            if ($moshaf['id'] == $rewaya) {
                return $moshaf;
            }
        }
        return [];
    }


    /**
     * Retrieves the suwar associated with a specific reciter and rewaya.
     *
     * @param int $id The ID of the reciter.
     * @param int $rewaya The ID of the rewaya.
     * @return \Illuminate\Support\Collection A collection of suwar for the specified reciter and rewaya.
     */
    public function getSuwarByReciterRewaya($id, $rewaya): Collection
    {
        try {
            $reciter = $this->reciters->where('id', $id)->first();
            foreach ($reciter['moshaf'] as $moshaf) {
                if ($moshaf['id'] == $rewaya) {
                    $suwar_ids = explode(',', $moshaf['surah_list']);
                    return $this->suwar->whereIn('id', $suwar_ids);
                }
            }
            return collect([]);
        } catch (Throwable $e) {
            return collect([]);
        }
    }





}
