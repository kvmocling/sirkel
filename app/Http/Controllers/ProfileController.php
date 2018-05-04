<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\friendships;
use App\notifications;


class ProfileController extends Controller
{
    public function index($id){
        $user = User::find($id);
        // dd($user->profile);
        // $userData = DB::table('users')
        //     ->leftJoin('profiles','profiles.user_id', 'users.id')
        //     ->where('users.id', $id)
        //     ->get();

            // dd($userData[0]);

         // $data = DB::table('users')->leftJoin('profiles', 'profiles.user_id','users.id')->where('users.id', Auth::user()->id)->get();

         // dd($userData);   

        // dd($user);  

    	return view ('profile.index', compact('user'));
    }

    public function uploadPhoto(Request $request){

    	$file = $request->file('pic');
    	$filename = $file->getClientOriginalName();

    	$path = 'image';
    	$file->move($path, $filename);
    	$user_id = Auth:: user()->id;

    	DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);

    	// return view('profile.index');
    	return back();
    }


    public function editProfileForm(){
                $data = DB::table('users')->leftJoin('profiles', 'profiles.user_id','users.id')->where('users.id', Auth::user()->id)->get();

        return view('profile.editProfile')->with('data', $data);
    }

    public function updateProfile(Request $request){

        // dd($request->all());
        $user_id= Auth::user()->id;

        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));

        return back();

    }

    public function findFriends(){

    $uid = Auth::user()->id;
    $allUsers= DB::table('profiles')
            ->leftJoin('users','users.id', '=', 'profiles.user_id')
            ->where('users.id', '!=', $uid)->get();

    return view('profile.findFriends',compact('allUsers'));
    }


    public function sendRequest($id){
        // echo $id;

            Auth::user()->addFriend($id);

            return back();

    }

    public function requests(){

        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requester')
                    ->where('status', 0) //if status 0 then have request else 1 for accepted    
                        ->where('friendships.user_requested', '=', $uid)->get();

        return view('profile.requests', compact('FriendRequests'));


        // return view('profile.requests');
    }

    public function accept($firstname, $id)
    {
        // echo $id;
        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
                    ->where('user_requested', $uid)
                    ->first();

        if($checkRequest) {
            // echo "yes, update here";
        $updateFriendship = DB::table('friendships')
                            ->where('user_requested', $uid)
                                ->where('requester', $id)
                            ->update(['status' => 1]);

        // $updateFriendship2 = DB::table('friendships')
        //                     ->where('user_requested', $id)
        //                         ->where('requester', $uid)
        //                     ->update(['status' => 1]);


        $notifications = new notifications; 

         $notifications->note = 'accepted your friend request';
        $notifications->user_hero = $id; // who is accepting my request
        $notifications->user_logged = Auth::user()->id; // me
        $notifications->status = '1'; //unread notification
        $notifications->save();       


        if($notifications) {

                 return back()->with('msg','You are now Friends with '. $firstname);

            }               

        }
        else
        {
                 return back()->with('msg','You are now Friends with this user');
        }

    }


    public function friends(){
        $uid = Auth::user()->id;

        $friends1 = DB::table('friendships') // who send me request
                ->leftJoin('users','users.id', 'friendships.user_requested') //who is not logged in but send request to
                ->where('status', 1)
                ->where('requester',$uid) //who is logged in
                ->get();

        // dd($friends1);

        $friends2 = DB::table('friendships') // I sent request to which user
                ->leftJoin('users','users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested',$uid )
                ->get();

        // dd($friends2);

        $friends = array_merge($friends1->toArray(),$friends2->toArray()); 
        
        // dd($friends);   
        return view('profile.friends', compact('friends'));   

    }

    public function requestRemove($id){

        // echo $id;
        DB::table('friendships')
            ->where('user_requested', Auth::user()->id)
            ->where('requester', $id)
            ->delete();

        return back()->with('msg', 'Request has been deleted');    

    } 

    public function notifications($id){

        $uid = Auth::user()->id;

        $notes = DB::table('notifications')
                ->leftJoin('users','users.id', 'notifications.user_logged')
                ->where('notifications.id', $id)
                ->where('user_hero', $uid)
                ->orderBy('notifications.created_at', 'desc')
                ->get();

         $updateNoti = DB::table('notifications')
                    ->where('notifications.id', $id)
                    ->update(['status' => 0]);

         return view('profile.notifications', compact('notes'));  
    }

    public function sendMessage(Request $request){
        $conID = $request->conID;
        $msg = $request->msg;

        $checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
      if($checkUserId[0]->user_from== Auth::user()->id){

        //fetch user_to
        $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
            // ->where('user_to', '!=', Auth::user()->id)
            ->get();
        
        $userTo = $fetch_userTo[0]->user_to;
        }else{
            //fetch user_to
            $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
                    ->get();
                    $userTo = $fetch_userTo[0]->user_to;
        }

        //now send message
        $sendM = DB::table('messages')->insert([
            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'msg' => $msg,
            'status' => 1,
            'conversation_id' => $conID
        ]);

        if($sendM){

            // echo "msg sent";

             $userMsg = DB::table('messages')
            ->Join('users', 'users.id', 'messages.user_from')
            ->where('messages.conversation_id', $conID)->get();
            // echo "message sent";
            return $userMsg;

            // return back()->with('msg', 'message sent'); 
        }


    }

    public function newMessage(){
      $uid = Auth::user()->id;

      $friends1 = DB::table('friendships')
              ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
              ->where('status', 1)
              ->where('requester', $uid) // who is loggedin
              ->get();

      $friends2 = DB::table('friendships')
              ->leftJoin('users', 'users.id', 'friendships.requester')
              ->where('status', 1)
              ->where('user_requested', $uid)
              ->get();

      $friends = array_merge($friends1->toArray(), $friends2->toArray());
      return view('newMessage', compact('friends', $friends));
    } 

    public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        //check if conversation already started or not
        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
        ->where('user_two',$friend_id)->get(); // if loggedin user started conversation

        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
        ->where('user_one',$friend_id)->get(); // if loggedin recviced message first

        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());

        if(count($allCons)!=0){
          // old conversation
          $conID_old = $allCons[0]->id;
          //insert data into messages table
          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'conversation_id' =>  $conID_old,
            'status' => 1
          ]);
        }else {
          // new conversation
          $conID_new = DB::table('conversation')->insertGetId([
            'user_one' => $myID,
            'user_two' => $friend_id
          ]);
          echo $conID_new;

          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'conversation_id' =>  $conID_new,
            'status' => 1
          ]);

        }
    }

     



}

