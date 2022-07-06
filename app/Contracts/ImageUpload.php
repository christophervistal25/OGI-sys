<?php

namespace App\Contracts;

interface ImageUpload
{
    public function upload(UploadedFile $file): void;

    public function hasFile(string $name = 'profile'): bool;
}
