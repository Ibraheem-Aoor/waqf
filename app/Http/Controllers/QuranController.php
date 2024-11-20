<?php

namespace App\Http\Controllers;

use App\Services\QuranService;
use Illuminate\Http\Request;
use Closure;
use App\Services\WaqfService;


class QuranController extends Controller
{

    protected $user;
    public function __construct(protected QuranService $quran_service, protected WaqfService $waqf_service, Request $request)
    {
        // Middleware to manage user session
        $this->middleware(function ($req, Closure $next) use ($request) {
            $user = $request->route('user');

            if ($user) {
                $req->session()->put('user', $user); // Store the user in session
            }

            // Fetch user from session if not already set
            $this->user = $this->waqf_service->setUser($req->session()->get('user'))->getUser();
            return $next($req);
        });
    }
    public function index()
    {
        $data['suwar'] = $this->quran_service->getSuwar();
        $data['user'] = $this->user;
        return view('site.pages.quran.index', $data);
    }

    public function showSura($id)
    {
        $data['sura'] = $this->quran_service->getSuwar()->where('id', $id)->first();
        $data['user'] = $this->user;

        return view('site.pages.quran.sura', $data);
    }

    public function reciterIndex()
    {
        $data['reciters'] = $this->quran_service->getReciters();
        $data['user'] = $this->user;

        return view('site.pages.quran.reciter', $data);
    }

    public function reciterSuwar($id, $rewaya)
    {
        $data['suwar'] = $this->quran_service->getSuwarByReciterRewaya($id, $rewaya);
        $data['reciter'] = $this->quran_service->getReciters()->where('id', $id)->first();
        $data['rewaya'] = $rewaya;
        $data['user'] = $this->user;

        return view('site.pages.quran.reciter_sura_index', $data);
    }


    public function reciterListen($reciter, $sura, $rewaya)
    {
        $data['reciter'] = $this->quran_service->getReciters()->where('id', $reciter)->first();
        $data['sura'] = $this->quran_service->getSuwar()->where('id', $sura)->first();
        $data['moshaf'] = $this->quran_service->findReciterReaway($reciter, $rewaya);
        $data['user'] = $this->user;

        return view('site.pages.quran.reciter_listen', $data);
    }

}
