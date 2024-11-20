<?php

namespace App\Http\Controllers;

use App\Models\Azkar;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.pages.home');
    }


    public function about(): View
    {
        return view('site.pages.about');
    }

    public function azkar(): View
    {
        $data['azkar'] = Azkar::query()->orderByDesc('created_at')->get();
        return view('site.pages.azkar.index', $data);
    }

    public function azkarShow($id): View
    {
        $data['zkr'] = Azkar::query()->findOrFail(decrypt($id));
        return view('site.pages.azkar.show', $data);
    }

    public function masbaha(): View
    {
        return view('site.pages.esbha.index');
    }
}
