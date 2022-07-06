<?php

namespace App\Repositories;

use App\Contracts\InstructorRepositoryContract;
use App\Instructor;
use Illuminate\Database\Eloquent\Collection;
use JD\Cloudder\Facades\Cloudder;

class InstructorRepository implements InstructorRepositoryContract
{
    protected $model;

    protected $uploader;

    public function __construct(Instructor $instructor, StudentImageUpload $uploader)
    {
        $this->model = $instructor;
        $this->uploader = $uploader;
    }

    public function get(): Collection
    {
        return $this->model->get();
    }

    public function find(int $id): Instructor
    {
        return $this->model->find($id);
    }

    public function update(array $items = []): bool
    {
        if (request()->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ['width' => 150, 'height' => 150]);
            $items['profile'] = $image_url;
        }

        if (is_null(request('password'))) {
            unset($items['password']);
        }

        return $this->find($items['id'])->update($items);
    }
}
