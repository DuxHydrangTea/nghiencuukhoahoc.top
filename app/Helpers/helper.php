<?php 

use Illuminate\Support\Facades\Storage;

if(!function_exists('storage_b2')){
    function storage_b2($b2_file_name){
        return Storage::disk('b2')->url( $b2_file_name);
    }
}

if(!function_exists('upload_folder_lesson')){
    function upload_folder_lesson($path){
        $files = File::allFiles(storage_path($path));
        foreach ($files as $file) {
            $relativePath = str_replace(
                public_path(),
                '',
                $file->getPathname()
            );
            Storage::disk('b2')->put(
                'lesson/bai-giang/' . $relativePath,
                file_get_contents($file->getRealPath())
            );
        }
        return 'lesson/bai-giang/' . $path .'/res/index.html';
    }
}