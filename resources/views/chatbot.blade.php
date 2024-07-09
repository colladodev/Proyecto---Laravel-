<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #chat-container {
            width: 350px;
            height: 500px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }
        #chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 20px;
            max-width: 80%;
        }
        .user-message {
            background-color: #007bff;
            color: white;
            align-self: flex-end;
            margin-left: auto;
        }
        .bot-message {
            background-color: #e9e9eb;
            color: black;
            align-self: flex-start;
        }
        #input-area {
            display: flex;
            padding: 10px;
            border-top: 1px solid #e0e0e0;
        }
        #user-input {
            flex-grow: 1;
            border: none;
            padding: 10px;
            border-radius: 20px;
            margin-right: 10px;
        }
        #send-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="chat-messages"></div>
        <div id="input-area">
            <input type="text" id="user-input" placeholder="Escribe tu mensaje...">
            <button id="send-button" onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script>
    function sendMessage() {
        var message = $('#user-input').val();
        if (message) {
            appendMessage('user', message);
            $.ajax({
                url: '/chatbot',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message
                },
                success: function(response) {
                    appendMessage('bot', response.response);
                }
            });
            $('#user-input').val('');
        }
    }

    function appendMessage(sender, message) {
        var messageClass = sender === 'user' ? 'user-message' : 'bot-message';
        var messageHtml = '<div class="message ' + messageClass + '">' + message + '</div>';
        $('#chat-messages').append(messageHtml);
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    }

    $('#user-input').keypress(function(e) {
        if(e.which == 13) {
            sendMessage();
        }
    });
    </script>
</body>
</html>