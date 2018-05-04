<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::post('sendMessagechat', array('uses' => 'ChatController@sendMessagechat'));
// Route::post('isTyping', array('uses' => 'ChatController@isTyping'));
// Route::post('notTyping', array('uses' => 'ChatController@notTyping'));
// Route::post('retrieveChatMessages', array('uses' => 'ChatController@retrieveChatMessages'));


Route::post('/sendMessage', 'ProfileController@sendMessage');
Route::post('sendNewMessage', 'ProfileController@sendNewMessage');
Route::get('newMessage','ProfileController@newMessage');

Route::get('/messages', function(){
	return view('messages');
});

Route::get('/chats/{id}', function($id){
	return view('/profile.chats');
});

Route::get('chats', 'ChatController@friendschat');




Route::get('/getMessages', function(){
	$allUsers1 = DB::table('users')
	->Join('conversation','users.id','conversation.user_one')
	->where('conversation.user_two', Auth::user()->id)->get();
	// return $allUsers;

	$allUsers2 = DB::table('users')
	->Join('conversation','users.id','conversation.user_two')
	->where('conversation.user_one', Auth::user()->id)->get();
	// return $allUsers;

	 return array_merge($allUsers1->toArray(),$allUsers2->toArray()); 

});

Route::get('/getMessages/{id}', function($id){


	$userMsg = DB::table('messages')
			->Join('users', 'users.id', 'messages.user_from')
			->where('messages.conversation_id', $id)->get();
			return $userMsg;


});


Route::get('/', function(){

	$noti = DB::table('notifications')
		->where('user_logged', Auth::user()->id)
		->get();

	dd($noti);	

});

Route::get('/count', function(){

	$count = App\notifications::where('status',1) // unread
		->where('user_hero', Auth::user()->id)
		->count();

	echo $count;	

});

Route::get('/', function () {

	$posts = DB::table('posts')
			->leftJoin('profiles','profiles.user_id', 'posts.user_id')
			->leftJoin('users', 'users.id', 'posts.user_id')
	->get();
    return view('welcome', compact('posts'));
});

Route::get('/test', function () {
    return Auth::user()->test();
});





Auth::routes();

Route::group(['middleware'=> 'auth'], function () {

	Route::get('/home', 'HomeController@index')->name('home');


	Route::get('profile/{id}', 'ProfileController@index');

	Route::get('/changePhoto', function(){

		return view ('profile.pic');
	});

	Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');

	Route::get('editProfile', 'ProfileController@editProfileForm');

	Route::post('/updateProfile','ProfileController@updateProfile');

	Route::get('/findFriends', 'ProfileController@findFriends');

	Route::get('/addFriend/{id}', 'ProfileController@sendRequest');

	Route::get('/requests', 'ProfileController@requests');

	Route::get('/accept/{firstname}/{id}', 'ProfileController@accept');

	Route::get('friends', 'ProfileController@friends');

	Route::get('requestRemove/{id}', 'ProfileController@requestRemove');

	Route::get('/notifications/{id}', 'ProfileController@notifications');

	Route::get('/unfriend/{id}', function($id){

		 $loggedUser = Auth::user()->id;
		// echo "<br>";
		// echo $id;

		DB::table('friendships')
		->where('requester', $loggedUser)
		->where('user_requested', $id)
		->delete();

		return back()->with('msg','You are not Friends');

	});

	
});

Route::get('posts', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');

