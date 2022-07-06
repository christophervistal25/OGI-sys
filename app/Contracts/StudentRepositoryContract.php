<?php

namespace App\Contracts;

use App\Repositories\StudentImageUpload;
use App\Student;
use Illuminate\Database\Eloquent\Collection;

interface StudentRepositoryContract
{
    public function __construct(Student $student, StudentImageUpload $uploader);

    public function get(): Collection;

    public function store(array $items = []): Student;

    public function find(int $id): Student;

    public function update(array $items = []): bool;
}
