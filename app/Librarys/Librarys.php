<?php
namespace App\Librarys;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class Librarys
{
    public static function new ($string = '') {
        return new static(null, $string);
    }

    public function me()
    {
        $me = Auth::user();
        return $me;
    }

    // Mounts image`s path
    public function filePath($data, $type)
    {
        $path;

        switch ($type) {
            case 'user':
                $path = 'files' . '/' . 'user' . '/' . $data['id'] . '/';
                break;

            case 'post':
                $path = 'files' . '/' . 'feed' . '/' . $data['id'] . '/';
                break;

            default:
                $path = false;
        }
        return $path;
    }

    public function storeFile($data, $type)
    {        
        // Set path and image name
        $fileName = pathInfo($data['photo']->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $data['photo']->getClientOriginalExtension();

        // Store image
        $isStored = Storage::disk('public')->put($this->filePath($data, $type) . $fileName . '.' . $extension, $data['photo'], 'public');

        if ($isStored) {
            // returns image path
            return $this->filePath($data, $type) . $fileName . '.' . $extension;
        }

        return null;
    }

    public function getFile($data, $type)
    {
        // If there is a image, returns it`s path
        if (count(Storage::disk('public')->allFiles($this->filePath($data, $type))) > 0){
            return 'upload/'.Storage::disk('public')->allFiles($this->filePath($data, $type))[0];
        }

        return null;
    }
}
