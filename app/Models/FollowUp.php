<?php

namespace App\Models;
use App\User;
use App\Models\Victim;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{


	// public function followUPExistsForCase(){
 //        return FollowUp::where('case_id',$this->id)->exists();
 //    }


    public function case()
    {
    	return $this->belongsTo(Victim::class);
    }

    public function user()
    {
    	//follow up has one user to look particulat case
    	return $this->belongsTo(User::class);
    }

   
}
