<?php
namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Category;
use App\Service;
use App\Sub_service;
class getDataController extends BaseController
{
   /* Get single category data and it's subcategories api */  
   
	public function getCategory(Request $request)
    {  
		$cat = Category::where('id', $request->id)->with('getServices.getSubServices')->get();
		if (count($cat)=== 0) {
            return $this->sendError('Category not found.');
        }else{
			return $this->sendResponse($cat, 'Data retrieved successfully.');
		}        		
    }
	
   /* Get all categories api */
   
	public function getAllCategory()
    {  
		$cat = Category::all();
		if (is_null($cat)) {
            return $this->sendError('Category not found.');
        }else{
			return $this->sendResponse($cat, 'Data retrieved successfully.');
		}        		
    }
	 
}
