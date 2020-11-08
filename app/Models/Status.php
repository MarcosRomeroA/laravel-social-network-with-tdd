<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// php artisan make:model Status -mc // crear modelo con migraciones y controller
class Status extends Model
{
    use HasFactory;

    protected $guarded = [];
}
