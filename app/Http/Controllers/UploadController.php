<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public $filename;
    
    public $imgpath;
    public function uploadImg($filename, $imgpath)
    {
        $file = $filename;
        $url_path = $imgpath;
        $rule = ['jpg', 'png', 'gif', 'jpeg'];
        if ($file->isValid()) {
            $clientName = $file->getClientOriginalName();
            $tmpName = $file->getFileName();
            $realPath = $file->getRealPath();
            $entension = $file->getClientOriginalExtension();
            if (!in_array($entension, $rule)) {
                return '图片格式为jpg,png,gif,jpeg';
            }
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $file->move($url_path, $newName);
            $namePath = $url_path . '/' . $newName;
            return $namePath; 
         
        } else {
            return false;
        }

    }
}
