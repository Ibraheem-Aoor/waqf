<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'whatsapp',
        'donation_link',
        'about',
        'about_waqf_male',
        'about_waqf_female',
        'logo',
    ];

}
