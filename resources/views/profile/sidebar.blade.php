    <div class="col-md-3">
        <div class="card">
                <div class="card-header">Sidebar-Quick Links</div>
                 @if(Auth::check())
                   <ul>
                     <li>
                       <a href="{{ url('/profile') }}/{{Auth::user()->id}}">
                          <img src=" {{ URL::to('/') }}/image/{{Auth::user()->pic}}"
                       width="50" style="margin:5px"  />
                      </a>
                     </li>
                     <li>
                       <a href="{{url('/friends')}}"> <img src="{{ URL::to('/') }}/image/friends.png"
                       width="50" style="margin:5px"  />
                      </a>
                     </li>
                     <li>
                       <a href="{{url('/newMessage') }}"> <img src="{{ URL::to('/') }}/image/msg.png"
                       width="50" style="margin:5px"  />
                      </a>
                     </li>

                     <li>
                       <a href="{{url('/findFriends')}}"> <img src="{{ URL::to('/') }}/image/f1.png"
                       width="50" style="margin:5px"  />
                      </a>
                     </li>

                   </ul>
                   @endif
        </div>        
      </div>