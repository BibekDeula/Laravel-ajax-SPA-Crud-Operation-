<?php

namespace App\Http\Controllers;


use App\Models\spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SpaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
            $datas=spa::orderBy('name','desc')->paginate(3);
            return view('SPA.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
      //x  dd(Session::all());
        // return view('grocery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $datas = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'trending' => 'required',
        ]);
        if ($datas->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $datas->messages(),
            ]);
        } else {
            $grocery = new spa();
            $grocery->name = $request->name;
            $grocery->address = $request->address;
            $grocery->trending = $request->trending;

            $grocery->save();
            return response()->json(['status' => 200, 'success' => 'Data is successfully added']);
        }

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
        $datas=spa::find($id);
        return response()->json($datas);
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
        $input = $request->all();
        $user = spa::find($id);
        $user->update($input);
        return response()->json(['status' => 200, 'success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas=spa::find($id);
       $users=$datas->delete();
       return response()->json($users);
        
    }
}
