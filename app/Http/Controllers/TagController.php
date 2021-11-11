<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Guest;
use Session;
use DB;
class TagController extends Controller
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
        $counter = [];

        $tags = Tag::where('deleted', '=', 0)->get();
        foreach ($tags as $tag) {
            $counter[$tag->name] = [
                'total' => 0,
                'bought' => 0,
                'entered' => 0,
            ];
        }

        $users = Guest::where('deleted', '=', false)->get();
        foreach ($users as $user) {
            $counter[$user->tag]['total'] += 1;
            $counter[$user->tag]['bought'] += (bool) $user->bought;
            $counter[$user->tag]['entered'] += (bool) $user->entered;
        }

        return view('tags')->with(compact('tags', 'counter'));
    }

    public function update_tag(Request $request)
    {
        if ($request->ajax()) {
            Tag::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);
  
            return response()->json(['success' => true]);
        }
    }

    public function delete_tag($id)
    {
        DB::table("tags")->where('id', '=', $id)->update(['deleted'=>1]);
        return response()->json(['success' => 'success']);
    }

    public function add_tag(){
        if (request('name') == NULL){
            Session::flash('message', "Name cannot be empty!");
        }else{
            $tag = new Tag;
            $tag->name = request('name');
            $tag->save();
            Session::flash('message', "Tag added!");
        }
        return redirect()->back();   
    }
}
