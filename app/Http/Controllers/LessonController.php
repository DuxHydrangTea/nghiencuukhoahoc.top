<?php

namespace App\Http\Controllers;

use App\Enums\ColorEnum;
use App\Models\Chapter;
use App\Models\Lesson;
use \Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use ZipArchive;

class LessonController extends Controller
{
    //
    public function upload(){
        $chapters = Chapter::all();
        $colors = ColorEnum::cases();
        return view('client.lesson.upload-lesson', compact('chapters', 'colors'));
    }

    public function handleUpload(Request $request){
        // handle thumbnail:
        $thumbnail = $request->file('thumbnail')->store('lesson/thumbnail', 'b2');
        // handle video:
        // $video_url = $request->video_url;
        // $localVideo = Storage::disk('public')->path($video_url);
        // $b2Video = Storage::disk('b2')->put($video_url, $localVideo);
        // $localVideo = Storage::disk('public')->delete($video_url);
        // handle sldide file:
        // $localSlide = $request->slide_url;
        // $slidePath = upload_folder_lesson($localSlide);
        $lesson = Lesson::create([
                "chapter_id" => $request->chapter_id,
                "title" => $request->title,
                "icon" => $request->icon,
                "description" => $request->description,
                // "video_url" => $b2Video,
                // "slide_url" => $slidePath,
                "duration" => $request->duration,
                "thumbnail" =>  $thumbnail,
                "tags" => $request->tags,
                "color" => $request->color,
        ]);

        if($lesson){
            return redirect()->route('lesson.uploadMedia', [
                'lesson' => $lesson,
            ]);
        }

        return redirect()->back()->with('error', 'Tạo bài giảng thất bại!');

    }

    public function uploadMedia(Lesson $lesson){
        return view('client.lesson.upload-lesson-media', compact('lesson'));
    }

    public function handleUploadMedia(Lesson $lesson, Request $request){
        // dd($request->all());
        $file = $request->file('video_url');
        if($file){
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = Storage::disk('b2')->putFileAs('', $file, $fileName);
            $lesson->video_url = $path;
            $lesson->save();

            return response([
                'message' => 'Tải lên thành công!',
            ], 200);
        }
    }

    public function chunkUploadZip(Request $request){
        $receiver = new FileReceiver("file", $request, ResumableJSUploadHandler::class);

        if (!$receiver->isUploaded()) {
            return response()->json(["done" => false, "msg" => "No file uploaded"]);
        }

        $save = $receiver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile();
            $fileName = 'lesson/' . ($request->mimeType ?? '') . time() . "_" . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('', $file, $fileName);

            $fileAbsPath = Storage::disk('public')->path($fileName);
            [$extractPath, $folderName, $folderPath]= $this->getNewFolderName($fileName);
            $zip = new ZipArchive();

            if ($zip->open($fileAbsPath) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
                // $this->uploadFolder($folderName);
                $files = File::allFiles(Storage::disk('public')->path($folderName));

                foreach ($files as $file) {
                    $relativePath = str_replace(
                        storage_path('app/public'),
                        '',
                        $file->getPathname()
                    );

                    Storage::disk('b2')->put(
                        $relativePath,
                        file_get_contents($file->getRealPath())
                    );
                }
                // Làm cái response và unlink folder
                return "Giải nén thành công vào: {$extractPath}";
            } else {
                return "Không thể mở file zip.";
            }
                /**
                 * 
                 * 
                 */
                // unlink($file->getPathname());
        }

        // Nếu chưa xong thì báo progress
        $handler = $save->handler();

        return response()->json([
            "done" => false,
            "percent" => $handler->getPercentageDone(),
        ]); 
    }

    private function getNewFolderName($path){
        $folderName = pathinfo($path, PATHINFO_FILENAME);
        $extractPath = Storage::disk('public')->path($folderName);

        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }

        return [$extractPath, $folderName, Storage::disk('public')->path($folderName)];

    }
}
