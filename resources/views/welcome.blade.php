<!-- {{$posts}}
 -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SirKel</title>

        <!-- Fonts -->
     <!--    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
<!-- 
             <link href="css/style.css" rel="stylesheet"/> -->
            <!--  <link rel="stylesheet" href="assets/css/main.css" /> -->

        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
            /*    background-color: #ddd;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;*/
                background:url(image/logotitle.png) no-repeat center center fixed;
            }



            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 100px;
                color: black;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            section
{
    width:100%;
    min-height: 1000;

}


        </style>
    </head>
    <body>



        <section class="wave">
        


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                       <!--  <a href="{{ url('/profile') }}">Profile</a> -->
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif


    <!--         <h1 class="title">SirKel</h1> -->

       <!--  <div class="container">
            <div id="app">
                @{{msg}}

            </div>    

             @foreach ($posts as $post)
                   <div class="row"> 
                    <div class="col-md-12" style="background-color:#fff">

                  <div class="row"> 
                      <div class="col-md-2">
                           <img src="{{ URL::to('/') }}/image/{{$post->pic}}" style="width:100px; margin:10px">
                      </div>   

                      <div class="col-md-10">
                        <h3>{{ucwords($post->firstname)}} {{ucwords($post->lastname)}}</h3>
                            <p><i class="fa fa-globe" aria-hidden="true"></i>{{($post->city)}}-{{($post->country)}}</p>
                        </div>
 

                          <p class="col-md-12" style="color:#333">{{$post->content}} </p>
                  </div> 
                
    @endforeach
 -->

                </section>                      
                        </div>
                      </div>


     
            </div>
        </div>



    </body>
</html>
