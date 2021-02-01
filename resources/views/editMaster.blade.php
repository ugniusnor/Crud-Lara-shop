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
            @foreach ($masters as $master)
            <h2>Edit {{$master->name}} details</h2>
                
            <form action="{{route('master.update',[$master->id])}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <input name="name" placeholder="{{$master->name}}" type="text" value="{{$master->name}}">
                <input name="surname" placeholder="{{$master->surname}}" type="text" value="{{$master->surname}}">
                <label for="">Avatar</label>
                <input id="image" type="file" name="image">
                <button type="submit" class="btn btn-blue"> Submit</button>
            </form>
            @endforeach
        </div>
        <h3 style="text-align: center; margin: 30px 0;">Active jobs</h3>
        <div class=" active-items-container">
            <div class="main-wrapper-header items-header">
                <div class="header-grid-item">Type</div>
                <div class="header-grid-item">Color</div>
                <div class="header-grid-item">Size</div>
                <div class="header-grid-item">Actions</div>
             </div>
             @foreach ($outfits as $item)
             <div class="main-container-row items-row">
                <div class="row-grid-item">{{$item->type}}</div>
                <div class="row-grid-item">{{$item->color}}</div>
                <div class="row-grid-item">{{$item->size}}</div>
                <div class="row-grid-item row-actions">
                    <div class="btn btn-red"> Delete</div>
                    <a href="{{route('outfit.edit', [$item])}}" class="btn btn-green"> Edit</a>
                </div>
                
                <div class="description-row">
                    <h3>Description</h3>
                    {!! $item->about !!}
                </div>
            </div> 
                 
             @endforeach
        </div>     
    </div>





</div>


<div>

</div>
@endsection