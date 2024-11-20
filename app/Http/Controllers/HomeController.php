<?php

namespace App\Http\Controllers;

use App\Models\Azkar;
use App\Services\WaqfService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected $user;
    public function __construct(protected WaqfService $waqf_service, Request $request)
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
    public function index(Request $request)
    {
        $data['user'] = $this->user;
        return view('site.pages.home', $data);
    }


    public function about(): View
    {
        $data['user'] = $this->user;
        return view('site.pages.about', $data);
    }
    public function aboutUser(): View
    {
        $data['user'] = $this->user;
        return view('site.pages.about_user', $data);
    }

    public function azkar(): View
    {
        $data['azkar'] = Azkar::query()->orderByDesc('created_at')->get();
        $data['user'] = $this->user;
        return view('site.pages.azkar.index', $data);
    }

    public function azkarShow($id): View
    {
        $data['zkr'] = Azkar::query()->findOrFail(decrypt($id));
        $data['user'] = $this->user;
        return view('site.pages.azkar.show', $data);
    }

    public function masbaha(): View
    {
        $data['user'] = $this->user;
        return view('site.pages.esbha.index', $data);
    }
}
