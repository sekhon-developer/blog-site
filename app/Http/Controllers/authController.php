<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Users;
use DB;
use Session;

class authController extends Controller
{
	public function admin_sign_in(){
		$results = DB::table('admin')->select('id')->where('email', $_POST['email']) ->where('password', $_POST['password'])->get();

		if(sizeof($results)>0){
		  foreach ($results as $result){
		    Session::put('admin', $result->id);
		    return response()->json(['success'=>true,'message'=>'User logged in successfully']);
		  }
		} else{
		  return response()->json(['success'=>false,'message'=>'Invalid login creditionals']);
		}
	}

	public function admin_sign_out(){
		Session::forget('admin');
		return redirect('/admin/sign-in');
	}

	public function sign_in(){
		$results = DB::table('users')->select('id')->where('email', $_POST['email']) ->where('password', $_POST['password'])->get();

		if(sizeof($results)>0){
		  foreach ($results as $result){
		    Session::put('user', $result->id);
		    return response()->json(['success'=>true,'message'=>'User logged in successfully']);
		  }
		} else{
		  return response()->json(['success'=>false,'message'=>'Invalid login creditionals']);
		}
	}

	public function sign_up(){
		$results = DB::table('users')->select('id')->where('email', $_POST['user_email'])->get();
		if(sizeof($results)>0){
		  return response()->json([
		  	'success'=>false,
		  	'message'=>'Email already exist',
		  	'focus'=>'email'
		  ]);
		} else{

		  $results = DB::table('users')->select('id')->where('mobile_number', $_POST['mobile_number'])->get();
			if(sizeof($results)>0){
			  return response()->json([
			  	'success'=>false,
			  	'message'=>'Mobile number already exist',
			  	'focus'=>'mobile_number'
			  ]);
			} else{
			  
				$user= new Users;
				$user->first_name 		= $_POST['first_name'];
				$user->last_name 			= $_POST['last_name'];
				$user->email 					= $_POST['user_email'];
				$user->mobile_number 	= $_POST['mobile_number'];
				$user->password 			= $_POST['password'];
				$user->save();
				
				return response()->json([
					'success'=>true,
					'message'=>'User registered successfully'
				]);
			}
		}
	}

	public function sign_out(){
		Session::forget('user');
		return redirect('/sign-in');
	}
}