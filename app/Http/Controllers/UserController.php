<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Privilege;
use Session;
use Illuminate\Http\Request;
use DB;
use App\Models\Tag;

class UserController extends Controller
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
        $tags=Tag::where('deleted', '=', 0)->get();
        $users=User::where('deleted', '=', 0)->get();
        return view('users')->with(compact('users','tags'));
    }

    public function update_user(Request $request)
    {
        if ($request->ajax()) {
            User::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);
  
            return response()->json(['success' => true]);
        }
    }

    public function delete_user($id)
    {
        DB::table("users")->where('id', '=', $id)->update(['deleted'=>1]);
        return response()->json(['success' => 'success']);
    }

    public function one_user($id)
    {
        DB::table("users")->where('id', '=', $id)->update(['role'=>1]);
        return response()->json(['success' => 'success']);
    }

    public function two_user($id)
    {
        DB::table("users")->where('id', '=', $id)->update(['role'=>2]);
        return response()->json(['success' => 'success']);
    }

    public function three_user($id)
    {
        DB::table("users")->where('id', '=', $id)->update(['role'=>3]);
        return response()->json(['success' => 'success']);
    }
}
