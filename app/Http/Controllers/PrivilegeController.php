<?php

namespace App\Http\Controllers;
use App\Models\Privilege;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use App\Models\Tag;

class PrivilegeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $privileges=Privilege::where('deleted', '=', 0)->get();
        $tags=Tag::where('deleted', '=', 0)->get();
        $counter = [];
        foreach ($privileges as $privilege){
            $counter[$privilege->id]=User::where([['deleted', '=', 0],['role', '=', $privilege->id]])->count();
        }
        return view('privileges')->with(compact('privileges','counter','tags'));
    }
}
