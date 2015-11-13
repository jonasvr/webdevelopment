<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ParticipantsController extends Controller
{
    public function __construct()
    {
       // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $users = DB::table('users')
                            ->whereNull('deleted_at')
                            ->whereNull('admin')
                            ->get();

            return view('participants', ['users' => $users]);
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //$user = user::find( $id );
        $users = User::where('id', $id)->first();
        $users->delete();
        return index();
    }

}
