<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFamilyBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'mother_firstname',
        'mother_middlename',
        'mother_lastname',
        'mother_contact_no',
        'father_firstname',
        'father_middlename',
        'father_lastname',
        'father_suffix',
        'father_contact_no',
    ];
}
