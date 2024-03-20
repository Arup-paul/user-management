<?php

namespace App\Services;

class UserImageUploadService implements UserImageUploadServiceInterface
{
    public function upload($file)
    {
        $filename = time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/photos', $filename);

        return $filename;
    }
}
