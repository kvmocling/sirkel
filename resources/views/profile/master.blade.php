<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://use.fontawesome.com/595a5020bd.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('', 'SirKel') }}</title>

    <!-- Scripts -->
   <!--  <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles --><!-- 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <link rel="stylesheet" href="style.css">

   <!--  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">




 

 <style>

 .img-circle{
    border-radius: 50%;

 }

 .img-rounded{
    border-radius:10px;

 }


 .space{
    margin-right: 10px;
    margin-left: 10px;
 }


 #contentarea
{
    height: 300px;
    border-left: solid 1px lightgray;
    border-right: solid 1px lightgray;
    overflow:auto;

}

</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <img src=" {{ URL::to('/') }}/image/logo1.png" width="70px" height="70px" class="img-circle" alt="Avatar" />
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('', 'SirKel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                         @auth
                        <!-- <li class="nav-item space">
                            <a href="{{url('/profile') }}">Profile</a>
                        </li> -->
                        <li class="nav-item space">
                            <a href="{{url('/findFriends') }}">Find Friends</a>
                        </li>
                         <li class="nav-item space">
                            <a href="{{url('/requests') }}">My Request<span style="color:green; font-weight:bold; font-size:16px">( {{App\friendships::where('status',0)->where('user_requested', Auth::user()->id)->count()}} )</span>
                            </a>
                        </li>

                        
                        @endauth
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else

                  <!--       <li> <a href="">
                                 <img src=" {{ URL::to('/') }}/image/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle" alt="Avatar" />
                             </a>
                        </li>   --> 

                         <ul class="navbar-nav">

                            <li class="nav-item space">
                            <a href="{{url('/newMessage') }}"><i class="fa fa-comments fa-2x" aria-hidden="true" style="margin-top: 7px"></i></a>
                        </li>

                             <li class="nav-item space">
                            <a href="{{url('/friends') }}"><i class="fa fa-users fa-2x" aria-hidden="true" style="margin-top: 6px"></i></a>
                        </li>


                            
                            <li class="nav-item dropdown">


                                <a id="navbarDropdown" class="nav-dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-globe fa-2x" aria-hidden="true" style="margin-top: 7px"></i>
                                    <div class="notification-counter">
                                    <span class="badge badge-dark" style="background:red; position:relative; top:-40px; left:15px; ">{{ App\notifications::where('status',1)
                                    ->where('user_hero', Auth::user()->id)
                                    ->count() }}</span>
                                    </div>   
                                </a>


                                <?php
                                $notes = DB::table('users')
                                    ->leftJoin('notifications','users.id', 'notifications.user_logged')
                                    ->where('user_hero', Auth::user()->id)
                                   // ->where('status', 1) //unread noti
                                    ->orderBy('notifications.created_at', 'desc')
                                    ->get();

                                    // dd($notes);
                                ?>

                                <ul class="dropdown-menu dropdown-menu-right" style="min-width:400px" role="menu">

                                 

                                    @foreach($notes as $note)

                                    <a href="{{URL('/notifications')}}/{{$note->id}}">                 
                                         @if($note->status==1)
                                        <li style="background:#E4E9F2; padding:5px">
                                            @else
                                            <li style="padding:5px">
                                        @endif   

                                    
                                    
                              
                                <div class="row">

                                      <div class="col-md-2" > 
                                        <img src="{{ URL::to('/') }}/image/{{$note->pic}}" style="width:40px; margin:3px; padding:3px; background:#fff; border:1px solid #eee" class="img-rounded">
                                       </div>
                                       
                                    <div class="col-md-10">


                                        <b style="color:green; font-size:90%">{{ucwords($note->firstname)}} {{ucwords($note->firstname)}} 
                                        </b>
                                        <span style="color:#000; font-size:90%"> {{ $note->note}}</span><br>
                                        <small style="color:#90949C"><i class="fa fa-users" aria-hidden="true"></i>{{ date('F j, Y', strtotime($note->created_at))}} at {{ date('H: i', strtotime($note->created_at))}}</small>
                                       
                                       

                                    </div>
                                </div>     
                                 </a></li>
                                    @endforeach
                                </ul>
                            
                        </ul> 
                             

  

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <img src=" {{ URL::to('/') }}/image/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle" alt="Avatar" /> <span class="caret"></span>
                                </a>

                            
 
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                     <a class="dropdown-item" href="{{ URL::to('/profile') }}/{{Auth::user()->id}}">Profile</a>

                                     <a class="dropdown-item" href="{{ URL('editProfile') }}">Edit Profile</a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>





                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>



<script src="/js/profile.js"></script>

<script src="/js/chats.js"></script>


<script type="text/javascript">
 $(function () {
    if (parseInt($(".notification-counter").text()) == 0) {
        //$(".notification-counter").hide();
        $(".notification-counter").hide();
    }
});

</script>

<!-- <script type="text/javascript">
 $(function () {
    if (parseInt($(".requests-counter").text()) == 0) {
        //$(".notification-counter").hide();
        $(".requests-counter").hide();
    }
});

</script> -->

<script>

$(document).ready( function(){
$('#contentarea').load('messages(privateMsg.id)');
refresh();
});

function refresh()
{
    setTimeout( function() {
      // $('#contentarea').fadeOut('slow').load('messages(privateMsg.id)').fadeIn('slow');
      $('#reloader').click();

      refresh();
    }, 5000);
}

// $('#reloader').click(function(){
//     $("#contentarea").load("messages(conID)");
// });


</script>





</body>
</html>
