<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request)
     {
       // dd('admin');
       // $items = DB::table('inventories')->select('id','name','quantity','owner_id','approved')->get();
       if ($request->ajax()) {
         $items = Inventory::where('approved','=',0)->get();
         // $items = Inventory::all();
         // dd($items);
         // return view('home')->with('items', $items);
           return Datatables::of($items)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
                            $btn = '
                            <form action="'.route('admin.approve',$row->id).'" method="POST">
                            <input type="hidden" name="id" value="'. $row->id .'"/>
                            <input type="hidden" name="approved" value="1"/>
                            <input type="hidden" name="_method" value="PUT"/>
                            <input type="hidden" name="_token" value="'. csrf_token() .'"/>
                            <button type="submit" class="btn btn-primary">Approve</button>
                            </form>

                            <form action="'.route('inventory.destroy',$row->id).'" method="POST">
                            <input type="hidden" name="id" value="'. $row->id .'"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="_token" value="'. csrf_token() .'"/>
                            <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                            ';

                             return $btn;
                     })
                     ->rawColumns(['action'])
                     ->make(true);

       }
       // dd($row);
       return view('home');
     }

     public function getItem()
     {
         $items = Inventory::all();
         // $items = Inventory::all();
         // dd($items);
         // return view('home')->with('items', $items);
           return Datatables::of($items)
                     ->addIndexColumn()
                     ->make(true);

     }

     public function getUser()
     {
         $items = User::all();
         // $items = Inventory::all();
         // dd($items);
         // return view('home')->with('items', $items);
           return Datatables::of($items)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
                            $btn = '
                            
                            <form action="'.route('user.disable',$row->id).'" method="POST">
                            <input type="hidden" name="id" value="'. $row->id .'"/>
                            <input type="hidden" name="disabled" value="1"/>
                            <input type="hidden" name="_method" value="PUT"/>
                            <input type="hidden" name="_token" value="'. csrf_token() .'"/>
                            <button type="submit" class="btn btn-primary">Disable</button>
                            </form>

                            <form action="'.route('user.destroy',$row->id).'" method="POST">
                            <input type="hidden" name="id" value="'. $row->id .'"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="_token" value="'. csrf_token() .'"/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            ';

                             return $btn;
                     })
                     ->rawColumns(['action'])
                     ->make(true);

     }

     public function approveRequest(Request $request, Inventory $inventory)
     {
       // B::table('users')->where('active', false)->chunkById(100, function ($users) {
       //      foreach ($users as $user) {
       //          DB::table('users')
       //              ->where('id', $user->id)
       //              ->update(['active' => true]);
       //      }
       //  });
       // $inventory->update($request->all());

       // dd($request);
     //   DB::table('inventories')->where('id','=',$request->id);
     //
     //   return redirect()->route('home')->with('success','Product updated successfully');
     // }

     $inventory->update($request->all());

     return redirect()->route('admin.dashboard')

                     ->with('success','Product updated successfully');

     }
}
