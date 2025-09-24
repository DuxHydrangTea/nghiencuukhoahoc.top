<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use \Illuminate\Support\Facades\Storage;
class ChunkUploadController extends Controller
{
    //
    public function __invoke(Request $request){
        $receiver = new FileReceiver("file", $request, ResumableJSUploadHandler::class);

        if (!$receiver->isUploaded()) {
            return response()->json(["done" => false, "msg" => "No file uploaded"]);
        }

        $save = $receiver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile();

            // Lưu file cuối cùng vào storage
            $fileName = 'lesson/' . ($request->mimeType ?? '') . time() . "_" . $file->getClientOriginalName();
            // $path = $file->storeAs( $fileName, "public");
            $path = Storage::disk('b2')->putFileAs('', $file, $fileName);
            // Xóa file tạm
            unlink($file->getPathname());

            return response()->json([
                "done" => true,
                "file_name" => $fileName,
            ]);
        }

        // Nếu chưa xong thì báo progress
        $handler = $save->handler();

        return response()->json([
            "done" => false,
            "percent" => $handler->getPercentageDone(),
        ]); 
    }
}
