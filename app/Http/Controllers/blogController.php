<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Likes;
use DB;
use Response;
use File;

class blogController extends Controller
{
	
	public function add(Request $request){
		$results = DB::table('blogs')
			->select('id')
			->where('title', $_POST['title'])
			->get();
		if(sizeof($results)>0){
			return response()->json([
				'success'=>false,
				'message'=>'Blog already exist'
			]);

		} else{
			$blog= new Blogs;
			$blog->category 							= $_POST['category'];
			$blog->title 									= $_POST['title'];
			if ($request->file('image')!='') {
				$blog_image=time().'_-_'.$request->file('image')->getClientOriginalName();
      	$request->file('image')->move(public_path().'/images/blogs/', $blog_image);
      	$blog->image 									= $blog_image;
      	$blog->video 									= '';
			} else{
				$blog->video 									= $_POST['video'];
				$blog->image 									= '';
			}
			
			$blog->description 						= $_POST['description'];
			$blog->added_at_date 					= date('d-M-Y');
			$blog->added_at_milliseconds	= time();
			$blog->save();
			
			return response()->json([
				'success'=>true,
				'message'=>'Blog added successfully'
			]);
		}
	}

	public function delete(){
		$blog_image_path = public_path().'/images/blogs/'.$_POST['image'];
		if (File::exists($blog_image_path)) {
			unlink($blog_image_path);
		}
		$blog = Blogs::find($_POST['id']);
		$blog->delete();
		return response()->json([
			'success'=>true,
			'message'=>'Blog deleted successfully'
		]);
	}


	public function update(Request $request){
		$results = DB::table('blogs')
			->select('id')
			->where('title', $_POST['title'])
			->where('id', '!=', $_POST['id'])
			->get();
		if(sizeof($results)>0){
			return response()->json([
				'success'=>false,
				'message'=>'Blog already exist'
			]);

		} else{
			$blog= Blogs::find($_POST['id']);
			$blog->category 							= $_POST['category'];
			$blog->title 									= $_POST['title'];
			if ($request->file('image')!='') {
				$blog_image=time().'_-_'.$request->file('image')->getClientOriginalName();
      	$request->file('image')->move(public_path().'/images/blogs/', $blog_image);
      	$blog->image 									= $blog_image;
      	$blog->video 									= '';
			} else{
				$blog->video 									= $_POST['video'];
			}
			
			$blog->description 						= $_POST['description'];
			$blog->added_at_date 					= date('d-M-Y');
			$blog->added_at_milliseconds	= time();
			$blog->save();
			
			return response()->json([
				'success'=>true,
				'message'=>'Blog added successfully'
			]);
		}
	}

	public function like(){
		DB::table('blog_likes')->where('blog_id',$_POST['blog_id'])->where('user_id',$_POST['user_id'])->delete();

		$like= new Likes;
		$like->blog_id 	= $_POST['blog_id'];
		$like->user_id 	= $_POST['user_id'];
		$like->status 	= 'like';
		$like->save();
			
		$likes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','like')
			->get();
		$total_likes = sizeof($likes);


		$dislikes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','dislike')
			->get();
		$total_dislikes = sizeof($dislikes);

	  return response()->json([
			'success'		=> true,
			'likes'			=> $total_likes,
			'dislikes'	=> $total_dislikes,
			'message'		=> 'Blog liked successfully'
		]);
	}

	public function unlike(){
		DB::table('blog_likes')->where('blog_id',$_POST['blog_id'])->where('user_id',$_POST['user_id'])->delete();
			
	  $likes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','like')
			->get();
		$total_likes = sizeof($likes);


		$dislikes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','dislike')
			->get();
		$total_dislikes = sizeof($dislikes);

	  return response()->json([
			'success'		=> true,
			'likes'			=> $total_likes,
			'dislikes'	=> $total_dislikes,
			'message'		=> 'Blog unliked successfully'
		]);
	}

	public function dislike(){
		DB::table('blog_likes')->where('blog_id',$_POST['blog_id'])->where('user_id',$_POST['user_id'])->delete();

		$like= new Likes;
		$like->blog_id 	= $_POST['blog_id'];
		$like->user_id 	= $_POST['user_id'];
		$like->status 	= 'dislike';
		$like->save();
			
		$likes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','like')
			->get();
		$total_likes = sizeof($likes);


		$dislikes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','dislike')
			->get();
		$total_dislikes = sizeof($dislikes);

	  return response()->json([
			'success'		=> true,
			'likes'			=> $total_likes,
			'dislikes'	=> $total_dislikes,
			'message'		=> 'Blog disliked successfully'
		]);
	}

	public function undislike(){
		DB::table('blog_likes')->where('blog_id',$_POST['blog_id'])->where('user_id',$_POST['user_id'])->delete();
			
	  $likes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('status','like')
			->get();
		$total_likes = sizeof($likes);


		$dislikes = DB::table('blog_likes')
			->select('id')
			->where('blog_id', $_POST['blog_id'])
			->where('user_id', $_POST['user_id'])
			->where('status','dislike')
			->get();
		$total_dislikes = sizeof($dislikes);

	  return response()->json([
			'success'		=> true,
			'likes'			=> $total_likes,
			'dislikes'	=> $total_dislikes,
			'message'		=> 'Blog undisliked successfully'
		]);
	}
}