<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/8/12
 * Time: 10:56 AM
 */

namespace App\Api\Controllers;


use App\Api\Controller;
use Dingo\Api\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $paths = [];
        try{
            if($request->hasFile('files')) {
                $files = $request->file('files');
                $files = is_array($files) ? $files : [$files];
                foreach ($files as $file) {
                    /**@var UploadedFile $file*/
                    $name = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                    $paths[] = Storage::url($file->storeAs('uploads', $name));
                }
            }
        }catch (\Exception $exception) {
            return $this->response->error($exception->getMessage());
        }

        return $this->response->array([
            'paths' => $paths
        ]);
    }
}
