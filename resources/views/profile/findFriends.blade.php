@extends('profile.master')

@section('content')





<div class="container">

  <ol class="breadcrumb">
<li>
  <a href="{{URL('/home')}}">Home</a>
  <label>/</label>
  <a href="{{ URL::to('/profile') }}/{{Auth::user()->id}}">Profile</a>
  <label>/</label>
  <a href="">Edit Profile</a>
</li>
</ol>

    <div class="row justify-content-center">
        @include ('profile.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{Auth::user()->username}}</div>


                <div class="card-body">
          <!--           @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->

 <!--                 <form action="{{URL('/updateProfile')}}" method="POST"> 
                   <input type="hidden" name="_token" value="{{csrf_token()}}"/> -->

                   <div class="row"> 
                    <div class="col-sm-12 col-md-12">
                      

                    
                      @foreach($allUsers as $uList)
                  <div class="row"> 
                      <div class="col-md-2">
                           <a href="">
                             <center><img src=" {{ URL::to('/') }}/image/{{$uList->pic}}" width="80px" height="80px" class="img-rounded" alt="Avatar" /></center>
                          </a>
                      </div>   

                      <div class="col-md-7">
                          <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->id}}">{{ucwords($uList->firstname)}} {{$uList->lastname}}</a></h3>
                         
                          <div class="caption">
                             <p> {{$uList->city}} - {{$uList->country}}</p>   
                          </div>

                        <p>{{($uList->about)}}</p>
                      </div> 

                      <div class="col-md-3">

                        <?php
                        $check = DB::table('friendships')
                                ->where ('user_requested', '=', $uList->id)
                                ->where ('requester', '=', Auth::user()->id)
                                ->first();

                         if($check==''){       

                        ?>

                        <p> 

                          <a href="{{URL('/')}}/addFriend/{{$uList->id}}" class="btn btn-sm btn-primary">Add to Friend</a>

                        </p>  

                        <?php } else {?>

                        <p>Request Already Sent</p>
                      <?php }?>

                      </div>
                  </div> 
                  <hr>
                       @endforeach  

                      
                        </div>
                      </div>

              



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
