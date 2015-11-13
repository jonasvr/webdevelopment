<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//added
use App\Inquiry;
use App\awnsers;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InquiryController extends Controller
{
    public function __construct()
    {
        //$this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiry = DB::table('inquiries')
                        ->orderBy('stop', 'desc')
                        ->first();
        $start = Carbon::parse($inquiry->stop);
        $stop   =  Carbon::parse($inquiry->stop)->addWeek();
        $data   = array('start' => $start, 'stop' => $stop);

        return view('createinquiry')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inquiry = DB::table('inquiries')
                        ->orderBy('stop', 'desc')
                        ->first();
        $start = Carbon::parse($inquiry->stop);
        $stop   =  Carbon::parse($inquiry->stop)->addWeek();
        
         $this->validate($request, [
            'inquiry'           =>  'required|max:255',
            'awnser'            =>  'required|max:255',
            'option1'           =>  'required|max:255',
            'option2'           =>  'required|max:255',
            'option3'           =>  'required|max:255',
            'start'             =>  'required|date:after:'.$start,
            'stop'              =>  'required|date:after:'.$stop,
         ]);

        $inputData                  = $request->all();        
        $inquiry                    = new Inquiry;

        $inquiry->question          = $inputData['inquiry'];
        $inquiry->awnser            = $inputData['awnser'];
        $inquiry->option1           = $inputData['option1'];
        $inquiry->option2           = $inputData['option2'];
        $inquiry->option3           = $inputData['option3'];
        $inquiry->start             = $inputData['start'];
        $inquiry->stop              = $inputData['stop'];
        
        $inquiry->save();

        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function play()
    {
        $inquiry = DB::table('inquiries')
                        ->where('start', '<', Carbon::now())
                        ->where('stop', '>=', Carbon::now())
                        ->first();

        $questionID = $inquiry->id;
        $question   = $inquiry->question;

        $userID =Auth::user()->id;

       
        $DBawnsers = DB::table('awnsers')
                    ->where('FK_user', $userID)
                    ->where('FK_inquiry', $questionID)
                    ->first();
        
        if (!$DBawnsers)
        {
            $awnsers = array($inquiry->option2, $inquiry->option3, $inquiry->option1, $inquiry->awnser);
            shuffle($awnsers);
            
            $quiz=array('question' => $question, 'awnsers' =>$awnsers, 'qId' => $inquiry->id );
            //var_dump($quiz);
            
           return view('play', ['quiz' => $quiz]);
        }
        else
        { 
            $givenAnwser = $DBawnsers->awnser;
            $shifting= $DBawnsers->shifting;
            $right = $inquiry->awnser;
            $quiz=array('question' => $question, 'given' =>$givenAnwser, 'shifting' => $shifting, 'right' => $right );
            return view('played', ['quiz' => $quiz]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awnser(Request $request)
    {
        $this->validate($request, [
            
            'awnser'            =>  'required',
            'shifting'          =>  'required|numeric',
         ]);

        $inputData                  = $request->all(); 
        //var_dump($inputData);       
        $awnser                     = new awnsers;

        $awnser->awnser            = $inputData['awnser'];
        $awnser->shifting          = $inputData['shifting'];
        $awnser->FK_inquiry        = $inputData['qId'];
        $awnser->FK_user           = $inputData['userId'];
        
        $awnser->save();

        return redirect()->route('home');
    }
}
