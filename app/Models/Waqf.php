<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waqf extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'color',
        'slug',
        'sex',
        'description',
    ];
    public $table = 'waqf';
}
