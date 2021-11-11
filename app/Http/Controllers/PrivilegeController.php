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

    public function update_privilege(Request $request)
    {
        if ($request->ajax()) {
            Privilege::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);
  
            return response()->json(['success' => true]);
        }
    }

    public function delete_privilege($id)
    {
        DB::table("privileges")->where('id', '=', $id)->update(['deleted'=>1]);
        return response()->json(['success' => 'success']);
    }

    public function add_tag(){
        if (request('name') == NULL){
            Session::flash('message', "Name cannot be empty!");
        }else{
            $tag = new Tag;
            $tag->name = request('name');
            $tag->save();
            Session::flash('message', "Privilege added!");
        }
        return redirect()->back();   
    }
}


