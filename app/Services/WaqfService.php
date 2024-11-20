<?php
namespace App\Services;

use App\Models\Waqf;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class WaqfService
{

    protected $model;
    protected $user;

    public function __construct()
    {
        $this->model = new Waqf();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($slug): object|null
    {
        $this->user = $this->model::query()->where('slug', $slug)->first();
        return $this;
    }


}
