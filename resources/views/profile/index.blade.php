@extends('profile.master')

@section('content')


<div class="container">


<ol class="breadcrumb">
<li>
  <a href="{{URL('/home')}}">Home</a>
  <label>/</label>
  <a href="{{ URL::to('/profile') }}/{{Auth::user()->id}}">Profile</a>
</li>
</ol>
    
    <div class="row justify-content-center">

      @include ('profile.sidebar')

    

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{$user->firstname}} {{$user->lastname}} </div>


                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                      <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">

                             <h3 align="center">{{$user->firstname}} {{$user->lastname}}</h3>
                             <img src=" {{ URL::to('/') }}/image/{{$user->pic}}" width="150px" height="150px" class="img-circle" />
                            <div class="caption">
                               
                            <p align="center">{{$user->profile->city}} - {{$user->profile->country}}</p>
                     
                      @if ($user->profile->user_id == Auth::user()->id)
                            <p align="center"><a href="{{URL('/editProfile')}}" class="btn btn-primary" role="button">Edit Profile</a></p>
                      @endif
                          </div>
                        </div>
                      </div>

                       <div class="col-sm-6 col-md-4">
                            <h4 class=""><span class="label label-default">About</span></h4>
                            <p>{{$user->profile->about}}</p>
                      </div>  


                    </div>

                     
                  
                </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
