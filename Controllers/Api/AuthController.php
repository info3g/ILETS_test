<?php
namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends BaseController
{
   /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), ['first_name' => 'required', 'last_name' => 'required', 'email' => 'required|email|unique:users', 'city' => 'required', 'province' => 'required', 'password' => 'required', 'confirm_password' => 'required|same:password']);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
		$input['role'] = '5';
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->first_name.' '.$user->last_name;   
        return $this->sendResponse($success, 'User register successfully.');
    }

	/**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role'=>'5'])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->first_name.' '.$user->last_name;   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

	/**
     * User Profile api
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function getProfile(Request $request)
    {         
		$user = User::find($request->id);	
		if (is_null($user)) {
            return $this->sendError('User not found.');
        }else{
			$user_detail= ['id' => $user->id, 'name' => $user->first_name.' '.$user->last_name, 'email' => $user->email, 'image' => $user->image, 'city' => $user->city, 'province' => $user->province, 'created_at' => $user->created_at->format('d-M-Y'), 'updated_at' => $user->updated_at->format('d-M-Y')];

            return $this->sendResponse($user_detail, 'User retrieved successfully.');
		}        		
    }

	/**
     * User Update Profile api
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function updateProfile(Request $request)
    {   
	    $input = $request->all();      
		$validator = Validator::make($request->all() ,['id'=> 'required', 'first_name' => 'required', 'last_name' => 'required', 'city' => 'required', 'province' => 'required', 'image' => 'required']);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 401);
        }
		if($request->image){
            $imagename=$this->imageUploadPost($request->image);
            $input['image']=$imagename;
        }

		$input['role'] = '5';
		$user = User::findOrFail($request->id);
		if (is_null($user)) {
            return $this->sendError('User not found.');
        }else{
			$user->fill($input)->save();
			$user_detail= ['id' => $user->id, 'name' => $user->first_name.' '.$user->last_name, 'email' => $user->email, 'image' => $user->image, 'city' => $user->city, 'province' => $user->province, 'created_at' => $user->created_at->format('d-M-Y'), 'updated_at' => $user->updated_at->format('d-M-Y')];

            return $this->sendResponse($user_detail,'User updated successfully.');
		}
        		
    }

	/**
     * Upload image function     
     */
	 
	public function imageUploadPost($image)
    {
        $imageName = time().'.'.$image->extension();  
        $image->move(public_path('uploads/profileImages'), $imageName);
        return $imageName;   
    } 
	
	
}

