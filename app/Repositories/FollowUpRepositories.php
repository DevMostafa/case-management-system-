<?php
namespace App\Repositories;

use App\Models\FollowUp;

class FollowUpRepositories{

	private $followUp;
   	
	public function __construct(FollowUp $followUp)
	{
		$this->followUp = $followUp;
    }
    public function followUpCreate(array $followUpData,$id)
    {
        $followUp = new $this->followUp;
        $followUp->case_id = $id;
        $followUp->user_id = $followUpData['user_id'];
        $followUp->description = $followUpData['description'];
        $followUp->save();
        return $followUp;
    }
    
    public function followUpUpdate(array $followUpData,$id)
    {
        return $this->followUp->where('case_id',$id)
            ->update([
                'user_id'=>$followUpData['user_id'],
                'description'=>$followUpData['description'],

            ]);
    }
	


}
