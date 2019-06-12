<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageHandler
{
    /**
     * This method will store a file.
     * @param  string  $storage
     * @param  resource $file
     * @param  string  $oldfile
     */
    public function upload($storage, $file, $oldFile = "")
    {
        if($file != "")
        {
            Storage::disk($storage)->delete($oldFile);
            $filenameWithExtension = time().'_'.$file->getClientOriginalName();
            Storage::disk($storage)->put($filenameWithExtension,  File::get($file));
            return $filenameWithExtension;
        }
        return "noImage.jpg";
    }

    /**
     * Will remove a file
     */
    public function delete($storage, $file)
    {
        Storage::disk($storage)->delete($file);
    }
}
