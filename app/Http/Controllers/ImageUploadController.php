<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\HelperApiTrait;

class ImageUploadController extends Controller
{

    use HelperApiTrait;

    public function index(Request $request)
    {
        $uploadedImages = $request->session()->get('uploaded');
        $countUploadedImages = $request->session()->get('count');
        $errors = $request->session()->get('errors') != null ? $request->session()->get('errors') : [];

        if(is_array($uploadedImages))
            krsort($uploadedImages);

        return view('upload',compact('uploadedImages','countUploadedImages','errors'));
    }

    public function store(Request $request)
    {
        $files = $request->file('files');
        $uploadedImages = $request->session()->get('uploaded');
        $countUploadedImages = $request->session()->get('count');
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

        session(['uploaded'=>$uploadedImages]);
        session(['count'=>$countUploadedImages]);
        session(['errors'=>$errors]);


        return redirect('upload-image-blade');

    }


    public function fushSessionData(Request $request)
    {

        $request->session()->flush();

        return redirect('upload-image-blade');
    }
}
