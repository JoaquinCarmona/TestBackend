<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait HelperApiTrait
{

    public function uploadImageToServer(String $fileEncoded)
    {

        $response = Http::asForm()->post('https://test.rxflodev.com',[
            'imageData' => $fileEncoded
        ]);

        $responseToArray = json_decode($response->body(),true);

        if($responseToArray['status'] === "success"){
            return $responseToArray["url"];
        }

        /*
         * return $responseToArray["message"];
         */

        return null;
    }

    public function encodeImageToBase64($file)
    {
        $fileEncoded = base64_encode(file_get_contents($file->path()));
        return $fileEncoded;
    }


}
