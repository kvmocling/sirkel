var userid;

$(document).ready(function(){

  userid = $('#userid').html();

    pullData();

  $(document).keyup(function(e){
    if (e.keyCode == 13)
      sendMessagechat();
    else
        isTyping();

  });

});

function pullData()
{
    retrieveChatMessages();
    setTimeout(pullData,3000);
}


function retrieveChatMessages()
{
    $.post('http://localhost:8000/retrieveChatMessages', {userid: userid}, function(data)
    {
        if (data.length > 0)
            $('#chat-window').append('data');
    });
}