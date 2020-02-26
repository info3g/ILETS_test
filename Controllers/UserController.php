<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
// use Validator,Redirect,Response,File;
use App\Service;
use App\Category;
use App\Sub_service;
use App\User;



class UserController extends Controller{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
 public function index(){
// 
 }
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
 public function create(){
 }
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
 public function store(Request $request){

	}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function show($id)
	{
//
	}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function edit($id){
		$user = User::findOrFail($id);
	return view('users.edit', compact('user'));
	}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function update(Request $request, $id){

		$validatedData = $request->validate([
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'image'=>'required|image|max:2048',
			'category' => 'required|max:255',

			'service' => 'required|max:255',
			'sub_service' => 'required|max:255',

			'company_name' => 'required|max:255',
			'employee_count' => 'required|max:255',
			'website' => 'required|max:255',
			'languages' => 'required|max:255',
			'contact_no' => 'required|max:11',
			'work_location' => 'required|max:255',
			'hourly_price' => 'required|max:255',
			'address' => 'required|max:255',
			'legal_structure' => 'required|max:255',
			'experience' => 'required|max:255',
			'bio' => 'required|max:500',
			'about_us' => 'required|max:255'
		]);
		User::whereId($id)->update($request->except(['_token','_method']));
	return redirect()->back();
	}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
	public function destroy($id){
//
	}
	public function updatePassword(Request $request){
		$this->validate($request, [
		'password'     => 'required',
		'new_password'     => 'required|min:6',
		'confirm_password' => 'required|same:new_password',
	]);
	$data = $request->all();
	$user = User::find(auth()->user()->id);
	if(!\Hash::check($data['password'], $user->password)){
	User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
	}else{
	}
}

	public function fileUploadPost(Request $request) {
		$path = 'uploads';
		$fileName = time().'.'.$request->image->extension();  
		$request->image->move(public_path($path), $fileName);
		$filelocation = $path.'/'.$fileName;
	User::find(auth()->user()->id)->update(['image'=> $filelocation]);
	return back()
	->with('success','You have successfully upload file.')
	->with('image',$fileName);
	}
  public function getServices($id) 
	{   

       $services = Service::where("category_id",$id)->get();
        return json_encode($services);
	}
	 public function getSubservices($id) 
	{   

       $sub_services = Sub_service::where("service_id",$id)->get();
        return json_encode($sub_services);
	}
	public function getCityList(Request $request)
        {
            $sub_services = DB::table("sub_services")
            ->where("service_id",$request->service_id)
            ->pluck("name","id");
            return response()->json($sub_services);
        }
}