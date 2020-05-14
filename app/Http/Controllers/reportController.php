<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reports;
use Response;

class reportController extends Controller
{
	public function report_blog(){
		$report= new Reports;
		$report->blog_id = $_POST['blog_id'];
		$report->user_id = $_POST['user_id'];
		$report->report_reason = $_POST['report_reason'];
		$report->description = $_POST['description'];
		$report->timestamp = time();
		$report->save();
			
		return response()->json([
			'success'=>true,
			'message'=>'Report submitted successfully'
		]);
	}
}