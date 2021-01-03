<?php
namespace app\model;
require '../core/Bootstrap.php';
use Illuminate\Database\Eloquent\Model as Model;

class NamaModel extends Model
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = "NamaTable";

   protected $fillable = [
       'name', 'email', 'password','userimage'
   ];
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
       'password', 'remember_token',
   ];
   /*
   * Get Todo of User
   *
   */
}