<?php

namespace Tests\Unit;

use App\Repositories\StudentImageUpload;
use App\Repositories\StudentRepository;
use App\Student;
use Tests\TestCase;

class StudentRepositoryTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->student = new Student();
        $this->studentRepository = new StudentRepository(
            $this->student,
            new StudentImageUpload()
        );
    }

    /**
     * @test
     */
    public function it_can_store_new_student()
    {
        $student = factory('App\Student')->make()
                                ->toArray();

        $student['password'] = 1234;

        $store = $this->studentRepository->store($student);

        $this->assertDatabaseHas('students', [
            'id_number' => $student['id_number'],
        ]);
        $this->assertInstanceOf('App\Student', $store);
    }

    /**
     * @test
     */
    public function it_can_find_student()
    {
        $insertedStudent = factory('App\Student')->create();

        $student = $this->studentRepository->find($insertedStudent->id);

        $this->assertInstanceOf('App\Student', $student);
        $this->assertEquals(
            $insertedStudent->id_number,
            $insertedStudent->id_number
        );
    }

    /**
     * @test
     */
    public function it_can_update_student()
    {
        $student = factory('App\Student')->create();
        $newStudentInformation = factory('App\Student')->make()
                                            ->toArray();
        $newStudentInformation['id'] = $student->id;

        $update = $this->studentRepository->update($newStudentInformation);

        $this->assertTrue($update);
        $this->assertDatabaseMissing('students', $student->toArray());
        $this->assertDatabaseHas('students', $newStudentInformation);
    }

    /**
     * @test
     */
    public function it_can_list_all_students()
    {
        factory('App\Student', 10)->create();

        $students = $this->studentRepository->get();

        $this->assertEquals(10, $students->count());
    }
}
