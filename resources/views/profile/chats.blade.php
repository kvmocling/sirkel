@extends('profile.master')

@section('content')  



<div class="col-md-12" style="padding:10px">
    <div class="row justify-content-center">



 <div class="col-lg-4 col-lg-offset-4">
        <h1 id="greeting">Hello, <span id="id">{{Auth::user()->id}}</span></h1>

        <div id="chat-window" class="col-lg-12">

        </div>
        <div class="col-lg-12">
            <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
            <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
        </div>
    </div>


</div>
</div>


 <div class="col-md-12" style="padding:10px">
    <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{Auth::user()->username}}, Your Friends</div>
                 <div class="col-md-3 pull-left">
                      <!--   <div class="card-header">{{Auth::user()->username}} Sidebar-Quick Links</div> -->
                            @foreach($friends as $uList)
                            <ul>
                                <li onclick="{{action('ChatController@retrieveChatMessages')}}" style="list-style:none; margin-top:10px; background-color:#F3F3F3" class="row">
                                   <a href="">
                                     <center><img src=" {{ URL::to('/') }}/image/{{$uList->pic}}" style="width:50px; border-radius:100%; margin:5px" class="img-round" alt="Avatar" />{{$uList->firstname}} {{$uList->lastname}} </center>
                                     <input type="text" class="form-control" placeholder="{{$uList->user_requested}}" id="friend_id" name="friend_id"/>
                                  </a>
                                </li>
                            </ul>     
                     @endforeach  
                  </div>     
                </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{Auth::user()->username}}</div>

                    <div id="chat-window" class="col-lg-12">

                    </div>
                    <div class="col-lg-12">
                        <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                        <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
                    </div>

            </div>
        </div>        


    </div>
</div>
                    



@endsection