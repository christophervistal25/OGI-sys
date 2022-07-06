<?php

namespace App\Service;

use App\Instructor;
use Illuminate\Support\Facades\Hash;

class InstructorService
{
    /**
     * It creates a new instructor record in the database
     *
     * @param array data
     * @return Instructor an instance of the Instructor model.
     */
    public function addInstructor(array $data = []): Instructor
    {
        return Instructor::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthdate' => $data['birthdate'],
            'department_id' => $data['department_id'],
            'contact_no' => $data['contact_no'],
            'status' => $data['work_status'],
            'civil_status' => $data['civil_status'],
        ]);
    }

    public function updateInstructor(array $data, $id): Instructor
    {
        $instructor = Instructor::find($id);

        $instructor->firstname = $data['firstname'];
        $instructor->middlename = $data['middlename'];
        $instructor->lastname = $data['lastname'];
        $instructor->email = $data['email'];
        $instructor->birthdate = $data['birthdate'];
        $instructor->department_id = $data['department_id'];
        $instructor->contact_no = $data['contact_no'];
        $instructor->status = $data['work_status'];
        $instructor->civil_status = $data['civil_status'];
        $instructor->password = ! is_null($data['password']) ? Hash::make($data['password']) : $instructor->password;
        $instructor->save();

        return $instructor;
    }
}
