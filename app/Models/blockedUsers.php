<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blockedUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'blockID',
        'firstUser',
        'secondUser',
        'blocked',
    ];
}
