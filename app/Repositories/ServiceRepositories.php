<?php 
namespace App\Repositories;

use App\Models\Service;

class ServiceRepositories{
	
	private $service;
   	
	public function __construct(Service $service)
	{
		$this->service = $service;
    }


    public function createServiceForCase(array $serviceData)
    {
    	return $this->service->create($serviceData);
    }

    public function updateServiceForCase(array $serviceData,$id)
    {
        return $this->service->where('case_id',$id)
            ->update([
                'service_name'=>$serviceData['service_name'],
                'description'=>$serviceData['description'],

            ]);

    }

}
