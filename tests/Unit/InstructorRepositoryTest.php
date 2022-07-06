<?php

namespace Tests\Unit;

use App\Instructor;
use App\Repositories\InstructorRepository;
use App\Repositories\StudentImageUpload;
use Tests\TestCase;

class InstructorRepositoryTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->instructor = new Instructor();
        $this->instructorRepository = new InstructorRepository($this->instructor, new StudentImageUpload());
    }

    /**
     * @test
     */
    public function it_can_store_new_instructor()
    {
        $instructor = factory('App\Instructor')->make()
                                ->toArray();

        $instructor['password'] = 1234;

        $instructor = $this->instructorRepository->store($instructor);

        $this->assertDatabaseHas('instructors', [
            'id_number' => $instructor['id_number'],
        ]);
        $this->assertInstanceOf('App\Instructor', $instructor);
    }

    /**
     * @test
     */
    public function it_can_find_instructor()
    {
        $insertedInstructor = factory('App\Instructor')->create();

        $instructor = $this->instructorRepository->find($insertedInstructor->id);

        $this->assertInstanceOf('App\Instructor', $instructor);
        $this->assertEquals(
            $insertedInstructor->id_number,
            $insertedInstructor->id_number
        );
    }

    /**
     * @test
     */
    public function it_can_update_instructor()
    {
        $instructor = factory('App\Instructor')->create();
        $newInstructorInformation = factory('App\Instructor')->make()
                                            ->toArray();
        $newInstructorInformation['id'] = $instructor->id;

        $update = $this->instructorRepository->update($newInstructorInformation);

        $this->assertTrue($update);
        $this->assertDatabaseMissing('instructors', $instructor->toArray());
        $this->assertDatabaseHas('instructors', $newInstructorInformation);
    }

    /**
     * @test
     */
    public function it_can_list_all_students()
    {
        factory('App\Instructor', 10)->create();

        $instructors = $this->instructorRepository->get();

        $this->assertEquals(10, $instructors->count());
    }
}
