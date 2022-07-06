<?php

namespace App\Service;

use App\Student;
use App\StudentEducation;

class StudentEducationService
{
    public function addNewStudentEducation(array $data, Student $student)
    {
        $educations[] = new StudentEducation([
            'name' => $data['elementary'],
            'from' => $data['elementary_from'],
            'to' => $data['elementary_to'],
            'address' => $data['elementary_address'],
            'type' => 'elementary',
            'average' => $data['elementary_average'],
        ]);

        $educations[] = new StudentEducation([
            'name' => $data['secondary'],
            'from' => $data['secondary_from'],
            'to' => $data['secondary_to'],
            'address' => $data['secondary_address'],
            'type' => 'highschool',
            'average' => $data['secondary_average'],
        ]);

        $student->educations()->saveMany($educations);
    }
}
