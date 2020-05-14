<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
  protected $table 			= 'reports';
  protected $primaryKey = 'id';
  public 		$timestamps	= false;
}