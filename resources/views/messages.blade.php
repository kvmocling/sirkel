@extends('profile.master')

@section('content')  

<style>

 .left-sidebar, .right-sidebar{
              background-color:#fff;
              height:600px;

            }

 #chat-window
{
    height: 400px;
    border-left: solid 1px lightgray;
    border-right: solid 1px lightgray;
}


</style>  



<div id="app">

<div class="col-md-12" style="padding:10px">
    <div class="row justify-content-center">

<div style="background-color:#fff" class="col-md-3 pull-left">
        <div class="row" style="padding:10px">
             <div class="col-md-4"> </div>
                <div class="col-md-6">Messenger</div>
                <div class="col-md-2 pull-right">
                   <a href="{{url('/newMessage') }}"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>
                </div>
        </div>
                  
        <div v-for="privateMsg in privateMsgs">
            <li @click="messages(privateMsg.id)" style="list-style:none; margin-top:10px; background-color:#F3F3F3" class="row">

                <div class="col-md-3 pull-left">
                    <img :src="'{{Config::get('app.URL')}}/image/' + privateMsg.pic" style="width:50px; border-radius:100%; margin:5px"/>
                </div>
            
                <div class="col-md-9 pull-left" style="margin-top:5px">
                    <b style="margin-left:10px">@{{privateMsg.username}}</b><br>
                    <!-- <p style="font-size:12px">display message here</p> -->
                </div>
            </li>
        </div>                              
    <hr>
</div>

    
        <div style="background-color:#fff; min-height:600px; border-left:5px solid #F5F8FA" class="col-md-6">

            

            <h3 align="center">Messages</h3>

             <input type="hidden" type="label" id="userid"  value="<?php echo Auth::user()->id; ?>"/>
            

           <div id="contentarea"> 

            <div v-for="singleMsg in singleMsgs">

          <!--   <div class="row"> -->
                <div v-if="singleMsg.user_from == <?php echo Auth::user()->id; ?>">

                    <div class="col-md-12 pull-left" style="margin-top:10px">
                       <!--  <div class="row justify-content-end"> -->
                            <img :src="'{{Config::get('app.URL')}}/image/' + singleMsg.pic" style="width:25px; border-radius:100%; margin:5px" class="pull-right"/>

                            <div style="float:right; background-color:#0084ff; padding:5px 15px 5px 15px; margin-right:10px;color:#333; border-radius:10px; color:#fff">
                                 @{{singleMsg.msg}}
                            </div>
                      <!--   </div> -->

                    </div>
                </div>    
                <div v-else>
                    <div class="col-md-12 pull-right" style="margin-top:10px">
                       <!--  <div class="row"> -->
                            <img :src="'{{Config::get('app.URL')}}/image/' + singleMsg.pic" style="width:25px; border-radius:100%; margin:5px" class="pull-left"/>

                            <div style="float:left; background-color:#F0F0F0; padding:5px 15px 5px 15px; margin-left:5px; text-align:right; border-radius:10px">
                                 @{{singleMsg.msg}}
                            </div>
                        <!-- </div>   -->  

                    </div>  
                </div>
           <!--  </div> -->  
            </div>
            <hr>

        </div>

                <input type="hidden" v-model="conID">
              <!--   <input type="text" v-model="idsearch"> -->
                <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                <textarea class="col-md-12 form-control" v-model="msgFrom" @keydown="inputHandler"
                style="margin-top:15px;"></textarea>

               

                <button style="display: none" id="reloader" @click="messages(conID)">Reloader</button>
         <!--        <button @click="increaseCount">Internal Button</button> -->
        <!--  <input type="button" class="btn btn-sm btn-outline-dark" value="send message" @click="messages(conID)"> -->

            


        </div>


         
   
   </div>
</div>




@endsection