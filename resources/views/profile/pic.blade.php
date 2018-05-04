@extends('profile.master')

@section('content')


<div class="container">

 <ol class="breadcrumb">
<li>
  <a href="{{URL('/home')}}">Home</a>
  <label>/</label>
  <a href="{{URL('/profile')}}">Profile</a>
  <label>/</label>
  <a href="{{URL('/editProfile')}}">Edit Profile</a>
  <label>/</label>
  <a href="">Change Image</a>
</li>
</ol>


    <div class="row justify-content-center">

        @include ('profile.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{Auth::user()->username}}</div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                         Edit your profile
                        <br>
                         <img src=" {{ URL::to('/') }}/image/{{Auth::user()->pic}}" width="80px" height="80px" /><br>
                       <a href="{{URL('/')}}/changePhoto" >Change Image</a><br>
                   </div>
                       
                        

                     <form action="{{URL('/')}}/uploadPhoto" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="file" name="pic" class="form-control" /> <br>

                        <input type="submit" class="btn btn-success" name="btn" />

                      </form>  
                
                    
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
