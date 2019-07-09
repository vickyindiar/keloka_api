<?php
namespace App\Http\Traits;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;



trait ImageHandlerTrait {

    // public function uploadOne(UploadedFile $uFile, $folder = null, $disk = 'public', $filename = null){
    //     $name = !is_null($filename) ? $filename : str_random(25);
    //     $file = $uFile->storeAs($folder, $name. '.' . $uFile->getClientOriginalExtension(), $disk);
    //     return $file;
    // }
    public function base64ToImage($base64_string, $output_file) {
        $file = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $output_file;
    }

    public function uploadOne(Request $request){
     $file = $request->has('image') ? base64_decode($request->json()->get('image'))  : ( $request->has('photo') ?  base64_decode($request->json()->get('photo'))  : null );
     try {
            if($file) {
                $name        = str_slug($request->json()->get('name')).'_'.time();
                $folder      = '/img/uploads/';
                $filePath    = $folder.$name.'.'.$file->getClientOriginalExtension();
                $uploaded    = $file->storeAs($filePath, $name.$file->getClientOriginalExtension());
                return $uploaded;
            }
            else {
                return null;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
