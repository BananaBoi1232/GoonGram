<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Message Requests</title>
    @include('navbar')
</head>
<body style="background-image: url('/css/black.png'); background-size: cover;">

    {{-- DM ID data loader --}}
    <div class="dmID d-none">{{ $dmId }}</div>

    <div id="messageContainer">
        @foreach($messages as $message)
            <div class="individualMessage">
                {{ $message->message }}
            </div>
        @endforeach
    </div>

    <div class="a d-flex justify-content-start flex-row fixed-bottom" style="margin-bottom: 10px;">
        <textarea class="message w-50" name="message" style="height:50px; resize:none; color: white; background-color: #212529; border: 2px solid white; border-radius: 20px; margin-right: 20px; padding: 10px; margin-bottom: 10px;" placeholder="Write Your Message Here"></textarea>
        <button class="messageBtn btn btn-dark" style="height:50px; background-color: #212529; border-radius: 20px; border: 2px solid white; color: white; margin-bottom: 10px;">Send</button>
    </div>

    <style>
        .individualMessage {
            display: block;
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid white;
            border-radius: 20px;
            color: white;
            padding: 5px;
            margin-bottom: 10px;
            margin-right: 60%;
        }

        .message::placeholder {
            color: white;
            opacity: 1;
        }

        .message:-ms-input-placeholder {
            color: white;
        }

        .message::-ms-input-placeholder {
            color: white;
        }

        .messageBtn:hover {
            background-color: black;
        }
    </style>

    <script>
        function fetchMessages() {
            var dmId = $(".dmID").html();

            $.ajax({
                type: 'GET',
                url: '/fetchMessages/' + dmId,
                cache: false,
                success: function(response) {
                    $("#messageContainer").empty();
                    response.messages.sort(function(a, b){
                        return new Date(a.created_at) - new Date(b.created_at);
                    });
                    $.each(response.messages, function(index, message) {
                        $("#messageContainer").append('<div class="individualMessage">' + message.message + '</div>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).ready(function(){
            fetchMessages();
            setInterval(fetchMessages, 5000);

            $(".messageBtn").click(function(e){
                e.preventDefault();

                var message = $(".message").val();
                var dmID = $(".dmID").html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/newMessage',
                    data: {
                        message: message,
                        dmID: dmID
                    },
                    cache: false,
                    success: function(response){
                        $(".message").val("");
                        fetchMessages();
                    }
                });
            });
        });

    </script>
</body>
</html>
