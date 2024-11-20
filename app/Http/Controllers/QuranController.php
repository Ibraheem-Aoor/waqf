<?php

namespace App\Http\Controllers;

use App\Services\QuranService;
use Illuminate\Http\Request;

class QuranController extends Controller
{
    public function __construct(protected QuranService $quran_service)
    {

    }
    public function index()
    {
        $data['suwar'] = $this->quran_service->getSuwar();
        return view('site.pages.quran.index', $data);
    }

    public function showSura($id)
    {
        $data['sura'] = $this->quran_service->getSuwar()->where('id', $id)->first();
        return view('site.pages.quran.sura', $data);
    }

    public function reciterIndex()
    {
        $data['reciters'] = $this->quran_service->getReciters();
        return view('site.pages.quran.reciter', $data);
    }

    public function reciterSuwar($id , $rewaya)
    {
        $data['suwar'] = $this->quran_service->getSuwarByReciterRewaya($id , $rewaya);
        $data['reciter'] = $this->quran_service->getReciters()->where('id', $id)->first();
        $data['rewaya'] = $rewaya;
        return view('site.pages.quran.reciter_sura_index', $data);
    }


    public function reciterListen($reciter , $sura , $rewaya)
    {
        $data['reciter'] = $this->quran_service->getReciters()->where('id', $reciter)->first();
        $data['sura'] = $this->quran_service->getSuwar()->where('id', $sura)->first();
        $data['moshaf'] = $this->quran_service->findReciterReaway($reciter , $rewaya);
        return view('site.pages.quran.reciter_listen', $data);
    }

}
