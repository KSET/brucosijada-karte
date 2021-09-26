<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\GuestImport;
use App\Exports\GuestExport;
use Illuminate\Http\Request;
use App\Models\Guest;
use Session;
use App\Models\Tag;
use DB;
use Spatie\QueryBuilder\QueryBuilder;

class GuestController extends Controller
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
        $guests=Guest::where([['deleted', '=', 0],['tag','=','Brucoš']])->get();
        $tags=Tag::where('deleted', '=', 0)->get();
        return view('guests')->with(compact('guests','tags'));
    }

    public function import_page()
    {
        $tags=Tag::where('deleted', '=', 0)->get();
        return view('import')->with(compact('tags'));
    }

    public function export_page()
    {
        //return view('export');
        return Excel::download(new GuestExport, 'guests.xlsx');
    }

    public function import_guests(Request $request){
        Excel::import(new GuestImport, $request->file);
        Session::flash('message', "Import successful!");
        return redirect()->back();    
    }

    public function update_guest(Request $request)
    {
        if ($request->ajax()) {
            Guest::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);
  
            return response()->json(['success' => true]);
        }
    }

    public function delete_guest($id)
    {
        $guest = Guest::find($id);
        $guest->update(['deleted'=>1]);
        $guest->save();
        return response()->json(['success' => 'success']);
    }

    public function buy_ticket($id)
    {
        DB::table("guests")->where('id', '=', $id)->update(['bought'=>1]);
        return response()->json(['success' => 'success']);
    }


    public function delete_ticket($id)
    {
        DB::table("guests")->where('id', '=', $id)->update(['bought'=>0]);
        return response()->json(['success' => 'success']);
    }

    public function add_guest(){
        if (request('name') == NULL || request('surname') == NULL || request('tag') == NULL){
            Session::flash('message', "All field are mandatory!");
        }else{
            $guest = new Guest;
            $guest->name = request('name');
            $guest->surname = request('surname');
            $guest->tag = request('tag');
            $guest->save();
            Session::flash('message', "Guest added!");
        }
        return redirect()->back();   
    }

    public function gates()
    {
        //$guests=Guest::where('deleted', '=', 0)->get();
        $tags=Tag::where('deleted', '=', 0)->get();

        $guests = QueryBuilder::for(Guest::class)
        ->allowedFilters(['tag'])
        ->where('deleted', '=', 0)
        ->get();

        return view('gates')->with(compact('guests','tags'));
    }

    public function enter_guest($id)
    {
        DB::table("guests")->where('id', '=', $id)->update(['entered'=>1]);
        return response()->json(['success' => 'success']);
    }

    public function kick_guest($id)
    {
        DB::table("guests")->where('id', '=', $id)->update(['entered'=>0]);
        return response()->json(['success' => 'success']);
    }

    public function guest_tag($tag)
    {
        $guests=Guest::where([['deleted', '=', 0],['tag','=',$tag]])->get();
        $tags=Tag::where('deleted', '=', 0)->get();
        return view('gates')->with(compact('guests', 'tags'));
    }

}
