<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
  protected $table 			= 'blog_likes';
  protected $primaryKey = 'id';
  public 		$timestamps	= false;
}