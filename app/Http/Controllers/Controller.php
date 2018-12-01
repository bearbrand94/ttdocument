<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function createSuccessMessage($payload){
		$result = [ "payload"=>$payload,
				    "error_msg"=>'',
					"code"=>200
					];
		return response()->json($result);
	}
	public function createErrorMessage($payload, $message=null, $code=500){
		$result = [ "payload"=>$payload,
				    "error_msg"=>$message,
					"code"=>$code
					];
		return response()->json($result);
	}
}
