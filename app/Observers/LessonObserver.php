<?php

namespace App\Observers;

use App\Models\Lesson;

class LessonObserver
{
    //
    public function creating(Lesson $lesson) {
        $this->_handleZipFile($lesson);
    }

    public function udpating(Lesson $lesson){
        $this->_handleZipFile($lesson);
    }

    private function _handleZipFile(Lesson $lesson){
        // dd($lesson->slide_url);
        if($lesson->slide_file){
            // unzip
        }
    }
}
