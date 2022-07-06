<?php

namespace App\Repositories;

use App\Contracts\ImageUpload;

class StudentImageUpload implements ImageUpload
{
    public function hasFile(string $name = 'profile'): bool
    {
        return request()->has($name);
    }

    public function upload($file): void
    {
        $name = $file->getClientOriginalName();
        $file->storeAs('public/images', $name);
    }
}
