<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;

trait ApiResponseTrait
{
public function apiResponse($data=null,$msg=null,$status=null){
    $array=[
        "data"=>$data,
        "msg"=>$msg,
        "status"=>$status
    ];
return response($array,$status);
}
}
