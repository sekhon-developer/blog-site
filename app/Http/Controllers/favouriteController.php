<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Favourites;
use DB;
use Response;

class favouriteController extends Controller
{
	public function add(){
		$favourite= new Favourites;
		$favourite->blog_id = $_POST['blog_id'];
		$favourite->user_id = $_POST['user_id'];
		$favourite->save();
			
	  return response()->json([
			'success'=>true,
			'message'=>'favourite added successfully'
		]);
		
	}

	public function delete(){
		DB::table('favourites')
		->where('blog_id',$_POST['blog_id'])
		->where('user_id',$_POST['user_id'])
		->delete();
		
		return response()->json([
			'success'=>true,
			'message'=>'favourite deleted successfully'
		]);
	}
}