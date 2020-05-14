<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
  protected $table 			= 'favourites';
  protected $primaryKey = 'id';
  public 		$timestamps	= false;
}