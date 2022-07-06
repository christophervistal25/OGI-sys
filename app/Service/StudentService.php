<?php

namespace App\Service;

use App\Student;
use App\StudentFamilyBackground;

class StudentService
{
    public function addNewStudent(array $data = []): Student
    {
        return Student::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'suffix' => $data['suffix'],
            'gender' => $data['gender'],
            'civil_status' => $data['civil_status'],
            'citizenship' => $data['citizenship'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'contact_no' => $data['contact_no'],
            'address' => $data['address'],
        ]);
    }

    public function addFamilyBackground(array $data, Student $student)
    {
        $student->familyBackground()->save(
            new StudentFamilyBackground([
                'mother_firstname' => $data['mother_name'],
                'mother_middlename' => $data['mother_middlename'] ?? '',
                'mother_lastname' => $data['mother_lastname'],
                'mother_contact_no' => $data['mother_contact_no'],
                'father_firstname' => $data['father_name'],
                'father_middlename' => $data['father_middlename'] ?? '',
                'father_lastname' => $data['father_lastname'],
                'father_suffix' => $data['father_suffix'],
                'father_contact_no' => $data['father_contact_no'],
            ])
        );
    }
}
