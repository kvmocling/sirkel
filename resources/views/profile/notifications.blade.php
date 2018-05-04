@extends('profile.master')

@section('content')





<div class="container">

  <ol class="breadcrumb">
<li>
  <a href="{{URL('/home')}}">Home</a>
  <label>/</label>
  <a href="{{URL('/profile')}}">Profile</a>
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


                       @if (session()->has('msg'))

                          <p class="alert alert-success">
                              {{ session()->get('msg')}}
                          </p>
                        @endif
                      

                    
                      @foreach($notes as $note)
        
                      <ul>
                        <li>
                          <p><a href="{{url('/profile')}}/{{$note->id}}" style="font-weight:bold; color:green">{{$note->firstname}} {{$note->lastname}}</a> {{$note->note}}</p>
                        </li>  

                      </ul> 
            


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
