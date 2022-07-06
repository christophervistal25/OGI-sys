<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from',
        'to',
        'address',
        'type',
        'average',
    ];
}
