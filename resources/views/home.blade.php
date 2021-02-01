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
            @if (session('deleteStatus'))
            <div class="main-wrapper-action succes"> 
               <p> {{session('deleteStatus')}}</p>            
               
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
            


             <div id="add_new_user" class="btn-blue">Add new</div>
             <form action="{{route('master.index')}}">
                 <input name="q" type="text" placeholder="search">
                 <button class="btn-blue">Find</button>
             </form>
             <div class="sort">
                 Sort by:
                 <a href="{{route('master.index',['sort'=>'name'])}}" class="sort-btn"> Name A-z</a>
                <a href="{{route('master.index',['sort'=>'name'])}}" class="sort-btn"> Surname A-z</a>
                <a href="{{route('master.index')}}" class="sort-btn"> Clear Filters</a>

             </div>

            
         </div>
         <div class="main-wrapper-header">
            <div class="header-grid-item">Name</div>
            <div class="header-grid-item">Surname</div>
            <div class="header-grid-item">Avatar</div>
            <div class="header-grid-item">Actions</div>
         </div>
         @foreach ($masters as $master)
         <div class="main-container-row">
             <div class="row-grid-item">{{$master->name}}</div>
             <div class="row-grid-item">{{$master->surname}}</div>
             <div class="row-grid-item">
                 <div class="avatar-img">
                @if ($master->avatar_url)
                <img src="{{asset("images/$master->avatar_url")}}" alt="">                    
                @endif
                 </div>
             </div>
            <div class="row-grid-item row-actions">
            
                 <form action="{{route('master.destroy',[$master])}}" method="POST">
                    @csrf
                    <button class="btn btn-red"  type="submit">Delete</button>            
                </form>
                <form action="{{route('master.edit',[$master])}}" method="get">
                
                    <button class="btn btn-green"  type="submit">Edit</button>            
                </form>
            </div>

         </div> 
         
            
         @endforeach

      
       
     </div>





 </div>


<div>
    <div class="popUp">
        <form action="/masters/store" method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Name</label>
             <input name="name" placeholder="Name" type="text" value="">
            <label for="">Surname</label>
             <input name="surname" placeholder="Surname" type="text" value="">
             <label for="">Avatar</label>
            <input id="image" type="file" name="image">
             <button class="btn-blue"> Submit</button>
         </form>
         <div class="closePop"> X </div> 
    </div>
</div>
                

@endsection
