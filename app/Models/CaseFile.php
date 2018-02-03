<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Victim;
use App\Models\CaseDescription;
class CaseFile extends Model
{
    protected $guarded = [];

    public function fileDescription()
    {
    	return $this->hasMany(CaseDescription::class,'id','description_id');

    }
}
