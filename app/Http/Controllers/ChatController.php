<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\friendships;
use App\notifications;

class ChatController extends Controller
{

    public function retrieveChatMessages()
    {
        $userid = messages::get('user_from');

        $message = messages::where('user_from', '!=', $userid)->where('status', '=', false)->first();

        if (count($message) > 0)
        {
            $message->status = true;
            $message->save();
            return $message->message;
        }
    }

    public function sendMessage(Request $request)
    {
        $userid = Input::get('id');
        $text = Input::get('text');
        $friend_id = $request->friend_id;

        $chatMessage = new ChatMessage();
        $chatMessage->user_from = $userid;
        $chatMessage->user_to = $friend_id;
        $chatMessage->msg = $text;
        $chatMessage->status = 1;
        // $chatMessage->save();
        dd($friend_id);
    }


    public function friendschat(){
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
        return view('profile.chats', compact('friends'));   

    }

}