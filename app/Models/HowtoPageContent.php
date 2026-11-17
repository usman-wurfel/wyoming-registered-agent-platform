<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowtoPageContent extends Model
{
    use HasFactory;

    protected $fillable = ['name','value','input_type','keywords'];
}
