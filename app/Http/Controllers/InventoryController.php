<?php

namespace App\Http\Controllers;

use App\inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use DataTables;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // dd('invent');
      // $items = DB::table('inventories')->select('id','name','quantity','owner_id','approved')->get();

      if ($request->ajax()) {
        $items = Inventory::where([
          ['owner_id','=',auth('web')->id()],
          ['approved','=',1]
        ]
          )->get();

        // $items = Inventory::all();
      // dd($items);
        // return view('home')->with('items', $items);
          return Datatables::of($items)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                           <form action="'.route('inventory.destroy',$row->id).'" method="POST">
                           <input type="hidden" name="id" value="'. $row->id .'"/>
                           <input type="hidden" name="_method" value="DELETE"/>
                           <input type="hidden" name="_token" value="'. csrf_token() .'"/>

                           <a href="'. route('inventory.edit',$row) .'"><button type="button" class="btn btn-warning">Edit</button></a>


                          <button type="submit" class="btn btn-danger">Delete</button>
                           ';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
      }
      return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd(auth('admin')->user()->id);
        $request->validate([
          'name'=>'required',
          'quantity' => 'required|integer'
        ]);

        $invent= new Inventory([
          'name' => $request->get('name'),
          'quantity' => $request->get('quantity'),
          'owner_id' => auth('web')->user()->id
        ]);
        // dd($invent);
      if(Auth::user()->disabled==0){$invent->save();}
      return redirect('/home')->with('success','Item Requested');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invent  $invent
     * @return \Illuminate\Http\Response
     */
    public function show(inventory $invent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invent  $invent
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
      // dd($inventory);
      // return Redirect::route('clients.show, $id')->with( ['data' => $data] );
      return view('edit-item')->with('item',$inventory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invent  $invent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventory $inventory)
    {
      $request->validate([

          'name' => 'required',

          'quantity' => 'required',

      ]);

      $inventory->update($request->all());

      return redirect()->route('home')

                      ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invent  $invent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->id,auth('web')->id());
        $items = Inventory::where([
          ['id','=',$request->id],
          ['owner_id','=',auth('web')->id()]
          ])->delete();

        // dd($items);
        // $items->destroy();
        return redirect('/home')->with('success','Item Requested');
    }
}
