<?php

namespace App\Http\Controllers;

use App\Traits\HelperApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{

    use HelperApiTrait;


    public function store(Request $request)
    {
        $files = $request->file('files');

        $uploadedImages = [];
        $countUploadedImages = 0;
        $errors = [];

        foreach ($files as $file){

            $fileEncoded = $this->encodeImageToBase64($file);
            $uploadedUrl = $this->uploadImageToServer($fileEncoded);
            if($uploadedUrl !== null){
                $uploadedImages[] = $uploadedUrl;
                $countUploadedImages = $countUploadedImages + 1;
            } else{
                $errors[] = $file->getClientOriginalName();
            }
        }



        krsort($uploadedImages);

        return response()->json([
            'status' => 'success',
            'uploaded_images' => $uploadedImages,
        ]);

    }


}
