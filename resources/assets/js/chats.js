var id;

$(document).ready(function(){

  id = $('#userid').html();

    pullData();

  $(document).keyup(function(e){
    if (e.keyCode == 13)
      // sendMessagechat();
    else
        isTyping();

  });

});

function pullData()
{
    retrieveChatMessages();
    setTimeout(pullData,3000);
}

function sendMessage()
{
    var text = $('#text').val();

    if (text.length > 0)
    {
        $.post('http://localhost:8000/sendMessage', {text: text, id: id}, function()
        {
            $('#chat-window').append('<br><div style="text-align: right">'+text+'</div><br>');
            $('#text').val('');
            notTyping();
        });
    }
}