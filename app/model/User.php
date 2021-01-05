<?php
namespace  Fariz\bird\app\model;
require '../core/Bootstrap.php';
use Illuminate\Database\Eloquent\Model as Model;

class User extends Model
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = "users";

   protected $fillable = [
       'name', 'email', 'password'
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