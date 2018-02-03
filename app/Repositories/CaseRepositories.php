<?php 
namespace App\Repositories;
use App\Models\Victim;
use Image;
use Storage;
use Session;
use Carbon\Carbon;
class CaseRepositories{
	private $victim;

	public function __construct(Victim $victim)
	{
		$this->victim = $victim;
        $this->perPage = 50;
	}
   

    public function getToken($lenght=6)
    {
    	$key = '';
    	$numeric = range(0,9);
    	$alphabetic = range('A','Z');
    	$keys = array_merge($numeric,$alphabetic);
    	for($i=0; $i<$lenght; $i++){
    		$key.= $keys[array_rand($keys)];
    	}
    	return $key;
    }

    public function create(array $caseRegisterData)
    {

        $caseRegisterData['token'] = $this->getToken(); 
        if(isset($caseRegisterData['image'])){

            $file = $caseRegisterData['image'];//$request->file('avatar');

            $path = $file->hashName('avatars');
            // avatars/bf5db5c75904dac712aea27d45320403.jpeg

            $image = Image::make($file);

            $image->fit(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path, (string) $image->encode('jpg'));
            $caseRegisterData['image'] = $path;
        }else{
            $caseRegisterData['image'] = 'default.png';
        }
       
        return $this->victim->create($caseRegisterData);
    }

    
    public function getOneCase($id)
	{
		return $this->victim->where('id',$id)->first();
	}

    public function allCases()
    {
        return $this->victim->orderBy('id','DESC')
            ->paginate($this->perPage);
    }

    public function searchCases($from = null,$to = null,$district = null)
    {
        $cases = $this->victim;
        if($from)
        {
            $cases = $cases->whereDate('created_at','>=',$from);
        }

        if($to)
        {
            $cases = $cases->whereDate('created_at','<=',$to);
        }
        
        if($district)
        {
            $cases = $cases->where('district_id',$district);
        }

        //store date range in session to grab when export method is fire
        Session::put('cases_fromDate', $from);
        Session::put('cases_toDate', $to);
        Session::put('district', $district);
        Session::put('countTotalRecords',$cases->count());

        return $cases->paginate(6);
    }
      //https://laracasts.com/discuss/channels/laravel/export-all-search-results
    public function searchCasesExport($type)
    {
        $from = Session::get('cases_fromDate', null); 
        $to = Session::get('cases_toDate',null);
        $district = Session::get('district',null);
        $cases = $this->victim::whereDate('created_at','>=', $from)
        ->whereDate('created_at','<=', $to);

        if($district){
            $cases = $cases->where('district',$district)->get();
        }else{
            $cases = $cases->get();
        }
        return \Excel::create('cases', function($excel) use($cases) {
          $excel->sheet('ExportFile', function($sheet) use($cases) {
              $sheet->fromArray($cases);
          });
      })->export($type);
   
    }


    public function caseFileStore(array $fileData,$id)
    {    
        $description = $fileData['description'];
        $desc = \App\Models\CaseDescription::create(['description'=>$description]);

        $files = [];
        foreach ($fileData['caseFile'] as $file) {
            if($file->isValid()) {
            $path = $file->store('public/caseFile');

        $files [] = [
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'victim_id'=>$id,
            'description_id'=>$desc->id,
            'created_at' => $now = Carbon:: now()->format('Ymd H: i: s'),
            'updated_at' => $now,
        ];
    }
}

      return  \App\Models\CaseFile::insert($files);

    }


    
}