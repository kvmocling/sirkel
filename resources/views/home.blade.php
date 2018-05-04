@extends('profile.master')

@section('content')
<div class="container">

  <ol class="breadcrumb">
<li>
  <a href="{{URL('/home')}}">Home</a>

</li>
</ol>


    <div class="row justify-content-center">

        @include ('profile.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
