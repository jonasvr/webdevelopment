<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//added
use DB;
use App\Winners;
use App\User;
use App\Inquiry;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $winners= DB::table('winners')
                    ->join('users', 'users.id', '=', 'winners.FK_user')
                    ->join('inquiries', 'inquiries.id', '=', 'winners.FK_inquiry')
                    ->select('users.name', 'users.surname', 'inquiries.question','inquiries.awnser', 'winners.FK_inquiry')
                    ->orderby('winners.FK_inquiry')
                    ->get();

                    /*echo '<pre>';
                    var_dump($winners);
                    echo '</pre>';*/
        return view('home', ['winners' => $winners]);
        
    }

}
