<?php

namespace App\Models;
use App\Models\CaseFile;
use Illuminate\Database\Eloquent\Model;

class CaseDescription extends Model
{
    protected $guarded = [];

    public function casedescription()
    {
    	return $this->belongsTo(CaseFile::class,'description_id','id');
    }


    


}
