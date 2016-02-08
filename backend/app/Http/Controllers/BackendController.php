<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Storage;
use DateTime;
use DateInterval;

class BackendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
    }

    /* upload image */
    public function uploadImage($poster,$dir,$friendly_url){
        if(isset($poster)){
            $file_name=$poster->getClientOriginalName();
            // set new filename
            $file_name=$friendly_url.substr($file_name,strrpos($file_name, "."));
            $poster->move(__DIR__.'/../../../public/images/'.$dir,$file_name);
            return $file_name;
        }
    }

    public function deleteImage($dir,$file){
    	if(isset($file)){
            Storage::delete($dir.'/'.$file);
        }
    }

    public function setFriendlyUrl($val){
        if(!empty($val)){
           return str_replace(" ", "_", strtolower($val))."_".rand(0,999999);
        }
    }

}
