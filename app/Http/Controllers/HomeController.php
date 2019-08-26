<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
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
      // dd('uwow');
        return view('home');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        $user = User::where([
          ['id','=',$request->id]
          ])->delete();

        // dd($user);
        // $items->destroy();
        return redirect('/home')->with('success','Item Requested');
    }

    public function disableUser(Request $request, User $user)
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
    // dd($request);
    $user->update($request->all());

    return redirect()->route('admin.dashboard')

                    ->with('success','Product updated successfully');

    }
}
