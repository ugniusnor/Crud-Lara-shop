@extends('layouts.app')

@section('content')
<aside>
    <div class="aside-wrapper">
        <ul>
            <a href="{{route('master.index')}}">
               <li> Dashboard</li>
           </a>
           <a href="{{route('master.index')}}">
             <li> Masters</li>
         </a>
         <a href="{{route('outfit.index')}}">
             <li> Outfits</li>
         </a>
       
        </ul>
    </div>
 </aside>
<div class="main-container">

    <div class="main-wrapper">
        @if (session('storeStatus'))
        <div class="main-wrapper-action succes"> 
           <p> {{session('storeStatus')}}</p>            
           
       </div>
           @endif
           @if ($errors->any())
            <div class="main-wrapper-action err"> 
                @foreach ($errors->all() as $error)
                <p> {{$error}}</p> <br>

            @endforeach
        </div>
               @endif
        <div class="form-container">
            <h2>Edit Item details</h2>
           
            <form action="{{route('outfit.update',[$outfit])}}" method="POST">
                @csrf
                <label for="">Asign master</label>
                <select name="master_id" id="">
                    @foreach ($masters as $master)
                    <option value="{{$master->id}}" @if ($master->id == $outfit->master_id)
                        selected="true"
                        
                    @endif>{{$master->name}} </option>                        
                    @endforeach
                 

                </select>
               <label for="">Type</label>
                <input
                value={{$outfit->type}}
                name="type" placeholder="Type" type="text">
               <label for="">color</label>
                <input
                value={{$outfit->color}}
                name="color" placeholder="Quality1" type="text">
            
               <label for="">size</label>
                <input
                value={{$outfit->size}}
                name="size" placeholder="Quality2" type="text">
                <label for="">Description</label>
                <textarea name="about" id="default" cols="30" rows="10">  {{$outfit->about}}</textarea>
             
                   
                </textarea>
                <button class="btn-blue"> Submit</button>
            </form>
        </div>
   
          
    </div>





</div>
@endsection
