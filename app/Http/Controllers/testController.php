<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//added
use DB;
use Carbon\Carbon;
# Include the Autoloader (see "Libraries" for install instructions)
use Mailgun\Mailgun;
use Mail;


class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $awnsers= DB::table('users')
                    ->join('awnsers', 'users.id', '=', 'awnsers.FK_user')
                    ->where('awnsers.created_at','>=',Carbon::today())
                    ->select('users.name','users.surname')
                    ->get();

        $file = fopen('file.csv', 'w');
        $csv = array();

        foreach ($awnsers as $row) {
             $csv[]=array("name" => $row->name,"surname" => $row->surname);
        }

        foreach ($csv as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

    Mail::raw('Laravel with Mailgun is easy!', function($message)
        {
            $message->to('jonasvanreeth@gmail.com');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
