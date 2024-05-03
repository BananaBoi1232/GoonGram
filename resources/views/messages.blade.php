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
<body>
    {{-- DM ID data loader --}}
    <div class="dmID d-none">{{ $dmId }}</div>

    @foreach($messages as $message)

        <div>
            {{ $message->message }}
        </div>
            

    @endforeach


    <div class = "a d-flex justify-content-center flex-row fixed-bottom">
        <textarea class = "message w-50" name = "message" style="height:100px; resize:none;" placeholder="Write Your Message Here"></textarea>
        <button class = "messageBtn">Send</button>
    </div>

    <script>

        $(document).ready(function(){
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
                        alert(response.message);
                    }
                }); 
            });
        });

    </script>
</body>
</html>