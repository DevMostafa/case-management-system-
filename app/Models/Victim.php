<?php

namespace App\Models;
use App\Models\Service;
use App\Models\FollowUp;
use App\Models\CaseFile;
use App\Models\District;
use App\Models\Incident;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
	//Case table is victim table
    protected $guarded = [];
    
    //helper function
    public function serviceGiveToThisId(){
    	return Service::where('case_id',$this->id)->exists();
    }
    public function followUPExistsForCase(){
        return FollowUp::where('case_id',$this->id)->exists();
    }

    //relationship
    public function service(){
    	return $this->hasOne(Service::class,'case_id');
    }
    
    //find user from users table from victim/case through followup
    public function users(){
        return $this->hasManyThrough(User::class, FollowUp::class,'case_id','user_id','id','id');
    }
    //each victim/case has one follow up
    public function followUP(){
     return $this->hasOne(FollowUp::class,'case_id');//case_id id foreign key on follow up table of victim table instead of case table
    }

    public function casefile(){
        return $this->hasMany(CaseFile::class);
    }

    public function district(){
        return $this->hasOne(District::class,'id','district_id');
    }
    public function incident(){
        return $this->hasOne(Incident::class,'id','incident_type_id');
    }
   
    
}
