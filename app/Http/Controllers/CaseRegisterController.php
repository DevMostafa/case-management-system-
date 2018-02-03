<?php

namespace App\Http\Controllers;
use App\Repositories\CaseRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use PDF;
use App\Http\Requests\FileValidationRequest;

class CaseRegisterController extends Controller
{
    protected $case;

    public function __construct(CaseRepositories $case)
    {
        $this->case = $case;
    }

    
    public function export(Request $request,$type)
    {
      $this->case->searchCasesExport($type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('from')||$request->get('to')||$request->get('district')){
            $checkDataCommingInView = $request->get('from');
            $cases = $this->case->searchCases(
                        $request->get('from'),
                        $request->get('to'),
                        $request->get('district'
                    ));

            
            return view('case.index',compact('cases','checkDataCommingInView'));

       }

        $cases = $this->case->allCases();




        return view('case.index',compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('case.create');
    }

    public function report(Request $request)
    {

        $from = \Session::get('cases_fromDate', null); 
        $to = \Session::get('cases_toDate',null);
        $district = \Session::get('district',null);
        if($request->view_type === 'download') {




        $cases = \App\Models\Victim::all();
            $pdf = PDF::loadView('case.pdf-download', ['cases' => $cases]);
            return $pdf->download('case.pdf');
        } else {

             
            $view = View('case.pdf-download', ['cases' => $cases]);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());
            return $pdf->stream();
            
        }
 
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'full_name' => 'required|max:100',//nullable or required
         // 'image' => 'required|file|max:2000'
    ]);

        $input = $request->all();
        $this->case->create($input);
        return"ok";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $case = $this->case->getOneCase($id);
        return view('case.show',compact('case'));
    }


    public function caseFile($id)
    {
        $id = $id;
        return view('case.fileUpload',compact('id'));
    }

    public function caseFileStore(FileValidationRequest $request,$id)
    {    
        $this->case->caseFileStore($request->all(),$id);
        return redirect()
        ->back ()
        ->withSuccess('File successfully uploaded.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
