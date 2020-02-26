<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Contactus;
use Validator;
class PostDataController extends BaseController
{

     /**
     * Submit contact form data Api
     *
     * @return \Illuminate\Http\Response
     */

    public function saveContactForm(Request $request)
    {
        $validator = Validator::make($request->all(), ['first_name' => 'required', 'last_name' => 'required', 'email' => 'required|email', 'message' => 'required']);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 401);
        }else{ 
	        $success="";
	        $input = $request->all();
	        Contactus::create($input);
	        return $this->sendResponse($success, 'Data successfully submitted.');
   	   }
    }
}
