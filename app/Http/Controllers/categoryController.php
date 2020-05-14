<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categories;
use DB;
use Response;

class categoryController extends Controller
{
	public function add(){
		$results = DB::table('categories')
			->select('id')
			->where('category_name', $_POST['category_name'])
			->get();
		if(sizeof($results)>0){

			return response()->json([
				'success'=>false,
				'message'=>'Category already exist'
			]);

		} else{
			$category= new Categories;
			$category->category_name = $_POST['category_name'];
			$category->save();
			
			return response()->json([
				'success'=>true,
				'message'=>'Category added successfully'
			]);
		}
	}


	public function update(){
		$results = DB::table('categories')
			->select('id')
			->where('category_name', $_POST['category_name'])
			->where('id', '!=', $_POST['id'])
			->get();
		if(sizeof($results)>0){

			return response()->json([
				'success'=>false,
				'message'=>'Category already exist'
			]);

		} else{
			$category 	= Categories::find($_POST['id']);
			$category 	->category_name = $_POST['category_name'];
			$category 	->save();
			
			return response()->json([
				'success'=>true,
				'message'=>'Category updated successfully'
			]);
		}
	}

	public function delete(){
		$category 	= 	Categories::find($_POST['id']);
		$category 	-> 	delete();
		return response()->json(['success'=>true,'message'=>'Category deleted successfully']);
	}
}