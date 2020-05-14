<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Response;

class profileController extends Controller
{
	public function update_admin_profile(){
		$admin 	= Admin::find($_POST['id']);
		$admin 	->first_name = $_POST['first_name'];
		$admin 	->last_name = $_POST['last_name'];
		$admin 	->email = $_POST['email'];
		$admin 	->save();
			
		return response()->json([
			'success'=>true,
			'message'=>'Profile updated successfully'
		]);
	}

	function update_admin_password(){
		$admin = Admin::find($_POST['id']);
		$admin ->password = $_POST['new_password'];
		$admin ->save();
			
		return response()->json([
			'success'=>true,
			'message'=>'Password updated successfully'
		]);
	}
}