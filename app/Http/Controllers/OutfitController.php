<?php

namespace App\Http\Controllers;
use App\Models\Master;
use App\Models\Outfit;
use Illuminate\Http\Request;

class OutfitController extends Controller
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
     
        if ($r->sort) {
            if($r->sort=="all") {
                $outfits = Outfit::all();
            } else {
                $outfits = Outfit::where('master_id',$r->sort)->get();
            }
        }
    
        elseif ($r->q) {
           
                $outfits = Outfit::where('about', 'like', '%'.$r->q.'%')->orWhere('type', 'like', '%'.$r->q.'%')->orWhere('color', 'like', '%'.$r->q.'%')->orWhere('size', 'like', '%'.$r->q.'%') ->get();
            
        }

        else {
            $outfits = Outfit::all();
        }

        // $outfits = Outfit::get()->all() ;
        $masters=Master::get()->all();
        return view('outfits',[
            'outfits'=>$outfits,
            'masters'=>$masters,
            "request"=>$r->sort
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
            'type'=>'required',
            'color'=>'required',    
            'size'=>'required',
            'about'=>'required',
            'master_id'=>'required'    
            ]);
          
            Outfit::create([
                'type'=>$request->type,
                'color'=>$request->color,    
                'size'=>$request->size,
                'about'=>$request->about,
                'master_id'=>$request->master_id    
            ]);
            return redirect()->route('outfit.index')->with('storeStatus', 'successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
       $masters= Master::get()->all();
        return view('editOutfit',[
            'outfit'=>$outfit,
            'masters'=>$masters,
            'master'=>$outfit->master()
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {
        $this->validate($request,[
            'type'=>'required',
            'color'=>'required',    
            'size'=>'required',
            'about'=>'required',
            'master_id'=>'required'    
            ]);
          
            $outfit->update([
                'type'=>$request->type,
                'color'=>$request->color,    
                'size'=>$request->size,
                'about'=>$request->about,
                'master_id'=>$request->master_id    
            ]);
            return redirect()->route('outfit.index')->with('storeStatus', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        //
    }
}
