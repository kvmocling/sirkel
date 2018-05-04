@extends('profile.master')

@section('content')




<!-- {{Auth::user()}} -->
<!-- {{$data}} -->



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

                 <form action="{{URL('/updateProfile')}}" method="POST"> 
                   <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                   <div class="row"> 
                    <div class="col-sm-12 col-md-12">
                        <div class="thumbnail">

                             <h3 align="center">{{ucwords(Auth::user()->username)}}</h3>
                         <center><img src="{{ URL::to('/') }}/image/{{Auth::user()->pic}}" width="120px" height="120px" class="img-circle" /></center>
                            <div class="caption">
                               
                            <p align="center">{{$data[0]->city}} - {{$data[0]->country}}</p>
                     
                            <p align="center"><a href="{{URL('/')}}/changePhoto" class="btn btn-primary" role="button">Change Image</a></p>
                          </div>
                        </div>
                      </div>

                    
                <!--    <input type="text" name="city" value="{{$data[0]->city}}"/> -->


                 <div class="col-sm-12 col-md-12">
                   <h3> Update Profile </h3>
                 </div>


                  <div class="col-md-6">
                     <span class="label label-default">About</span><br>
                      <div class="col-md-12"></div>
                        <div class="input-group">
                          <textarea type="text" class="form-control" name="about" >{{$data[0]->city}}</textarea>
                  </div>  
                </div>

                  <div class="col-md-6">
                    <span class="label label-default">City Name</span><br>
                      <div class="col-md-12"></div>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="{{$data[0]->city}}" name="city" aria-describedby="basic-addon1"/>
                        </div>
                        <br>

                     <span class="label label-default">Country Name</span><br>
                      <div class="col-md-12"></div>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="{{$data[0]->city}}" name="country" aria-describedby="basic-addon1"/>
                        </div> 
                        <br>
                     
                     <div class="col-md-12"></div>
                        <div class="input-group">
                          <input type="submit" class="btn btn-success pull right"/>
                        </div> 
                     
            </form> 


              





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
