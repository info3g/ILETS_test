<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Sections;
use App\Aboutus;

class CmsController extends Controller
{
   /**
	 * Display homepage sections edit page.
	 *
	 */
	public function HomePageSections(Request $request) {    

		$render_file = substr(\Request::url(), strrpos(\Request::url(), '/') + 1);        
		$sections = Sections::where('slug', $render_file)->first();
		$view = 'cms.homePageSections.'.$render_file;
		$data['sections'] = $sections;	
		///dd(empty($sections));
		return view()->exists($view) ? view($view, $data) : $this->pageNotFound();;
	}

	/**
	 * Submit homepage sections.
	 *
	 */
	public function submitSections(Request $request) {		
		$input =$request->all();           
		if($request->image){
			$imagename=$this->imageUploadPost($request->image);
			$input['image']=$imagename;
		}
		   $route=$request->route_name;
		   $input['slug']=$request->route_name;
		if(Sections::create($input)){
			return redirect('/websiteHomeSection/'.$route)->with('success', 'Section is successfully saved');
		}
	}

	/**
	 * Upload image function     
	 */
	 
	public function imageUploadPost($image) {
		$imageName = time().'.'.$image->extension();  
		$image->move(public_path('uploads/cms'), $imageName);
		return $imageName;   
	} 

	/**
	 * Update sections function     
	 */

	public function updateSections(Request $request, $id) {		
		$input =request()->except(['_token','_method','route_name', 'old_image']);
		if($request->image || $request->old_image){            
			if($request->image){
				$imagename = $this->imageUploadPost($request->image);
				$input['image'] = $imagename;
			}
			else{
				$input['image']=$request->old_image;

			}
		}

		$route=$request->route_name;
		$input['slug']=$request->route_name;

		if(Sections::whereId($id)->update($input)){
			return redirect('/websiteHomeSection/'.$route)->with('success', 'Section is successfully updated');
		}
	}

	/**
	 * method to show about us page    
	 */

	public function aboutUs(Request $request) {    
        $aboutus = Aboutus::first();   
        return view('cms.aboutUs.aboutUs', compact('aboutus'));	
	}

	/**
	 * method to submit about us page    
	 */

	public function aboutUsSubmit(Request $request) {	
	$input =request()->except(['_token','_method','old_image']);	
		$input =$request->all();           
		if($request->image){
			$imagename=$this->imageUploadPost($request->image);
			$input['image']=$imagename;
		}
		if(Aboutus::create($input)){
			return redirect('/aboutUs')->with('success', 'About Us is successfully saved');
		}
	}

	/**
	 * method to update about us page    
	 */
	public function updateAboutUs(Request $request, $id) {		
		$input =request()->except(['_token','_method','route_name', 'old_image']);
		if($request->image || $request->old_image){            
			if($request->image){
				$imagename=$this->imageUploadPost($request->image);
				$input['image']=$imagename;
			}else{
				$input['image']=$request->old_image;

			}
		}

		if(Aboutus::whereId($id)->update($input)){
			return redirect('/aboutUs')->with('success', 'About Us is updated');
		}
	}
}
