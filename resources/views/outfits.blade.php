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
        <div class="main-wrapper-action">
            <div id="add_new_item" class="btn-blue">Add new</div>
            <form action="{{route('outfit.index')}}" method="GET">
                <input name="q" type="text" placeholder="search">
                <button class="btn-blue">Find</button>
            </form>
            <form action="{{route('outfit.index')}}" method="GET">
                <select name="sort" id="">
                    <option value="all">All</option>
                    @foreach ($masters as $master)
                    <option @if ($master->id == $request)
                        selected="true"
                        
                    @endif  value="{{$master->id}}">{{$master->name}}</option>                        
                    @endforeach
                  
                </select>
                <button class="btn-blue">Sort</button>
            </form>
        </div>
        <div class="main-wrapper-header items-header">
           <div class="header-grid-item">Type</div>
           <div class="header-grid-item">Trait1</div>
           <div class="header-grid-item">Trait2</div>
           <div class="header-grid-item">Actions</div>
        </div>
        @foreach ($outfits as $outfit)
        <div class="main-container-row items-row">
            <div class="row-grid-item">{{$outfit->type}}</div>
            <div class="row-grid-item">{{$outfit->color}}</div>
            <div class="row-grid-item">{{$outfit->size}}</div>
            <div class="row-grid-item row-actions">
                <form action="{{route('outfit.destroy',[$outfit])}}" method="POST">
                    @csrf
                <button type="submit" class="btn btn-red">Delete</button>
                </form>
              
                <a href="{{route('outfit.edit',[$outfit])}}" class="btn btn-green"> Edit</a>
            </div>
            
            <div class="description-row">
                <h3>Description</h3>
                {!! $outfit->about !!}
            </div>
        </div> 
        @endforeach

        </div> 
    </div>





</div>

<div class="popUp">
    <form action="{{route('outfit.store')}}" method="POST">
        @csrf
        Assign Master
        <select name="master_id" id="">
           
            @foreach ($masters as $master)
            <option value="{{$master->id}}"> {{$master->name}}</option>    
            @endforeach
        </select>
       <label for="">Type</label>
        <input value="{{old('type')}}" name="type" placeholder="Type" type="text">
       <label for="">Color</label>
        <input value="{{old('color')}}" name="color" placeholder="Color" type="text">
       <label for="">size</label>
        <input value="{{old('size')}}" name="size" placeholder="Quality2" type="text">
        <label for="">Description</label>
        <textarea value="{{old('about')}}" name="about" id="" cols="30" rows="10" placeholder="About"></textarea>
        <button class="btn-blue"> Submit</button>

    </form>
    <div class="closePop"> X </div> 
</div>

<div>

</div>

@endsection