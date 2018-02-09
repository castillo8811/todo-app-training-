<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validate($request,$rules){
        $validate = Validator::make($request->all(),$rules);
        if($validate->fails())
        {
            response()->json(['message'=>'Please check your parameters and values', "error" => $validate->errors()], Response::HTTP_BAD_REQUEST)->send();
            die();
        }
    }
}
