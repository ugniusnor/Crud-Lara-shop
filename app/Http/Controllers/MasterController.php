<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Outfit;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        
        //sorting
        if ('name' == $r->sort) {
            $masters = Master::orderBy('name')->get();
        }
        elseif ('surname' == $r->sort) {
            $masters = Master::orderBy('surname')->get();
        }
        elseif ($r->query) {
           
                $masters = Master::where('name', 'like', '%'.$r->q.'%')->orWhere('surname', 'like', '%'.$r->q.'%') ->get();
            
        }
        else {
            $masters = Master::all();
        }

        //searching
        return view('home',[
            'masters'=>$masters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'surname'=>'required',        
            ]);
         
        
            Master::create([
                'name'=>$request->name,
                'surname'=>$request->surname,
            
            ]);
            return redirect()->back()->with('storeStatus', 'successfully inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masters = Master::get()->where('id',$id);
        $outfits = Outfit::get()->where('master_id',$id);
        return view('editMaster',[
            'masters'=>$masters,
            'outfits'=>$outfits

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {
        $this->validate($request,[
            'name'=>'required',
            'surname'=>'required',        
            ]);
          
            $master->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
            ]);
            return redirect()->route('master.index')->with('storeStatus', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        try {
            $master->delete();
        }        
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Master has standing job']);
            
        }



    }
}
