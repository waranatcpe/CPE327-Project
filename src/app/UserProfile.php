<?php
  
namespace App;
   
use Illuminate\Database\Eloquent\Model;
  
class UserProfile extends Model
{
	protected $table = 'user_profiles';
    protected $guarded = [];

    public function checkProfile(){
    	if($this->prefix != NULL){
    		return true;
    	}else{
    		return false;
    	}
    }
}