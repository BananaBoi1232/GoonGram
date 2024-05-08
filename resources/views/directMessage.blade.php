<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Direct Messages</title>

    @include('navbar')
</head>
<body>
    
    <div class = "d-flex flex-column">
        @foreach($results as $result)
            @if($result->firstId != auth()->user()->id)

                <div class = "d-flex userContainer">

                    <a href = "/showMessages/{{ $result->firstId }}">

                        <div class = "d-flex">

                            <img draggable="false" class = "profilePicture" name = "profilePicture" style = "width:50px; height:50px;" 
                            src="@if($result->firstPfp == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                                @else {{ asset('storage/'.$result->firstPfp) }}
                            @endif">

                            <div>{{ $result->firstUsername }}</div>

                        </div>

                    </a>

                </div>
                
            @elseif($result->secondId != auth()->user()->id)
                
                <div class = "d-flex userContainer">

                    <a href = "/showMessages/{{ $result->secondId }}">

                        <div class = "d-flex">

                            <img draggable="false" class = "profilePicture" name = "profilePicture" style = "width:50px; height:50px;" 
                            src="@if($result->secondPfp == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                                @else {{ asset('storage/'.$result->secondPfp) }}
                            @endif">

                            <div>{{ $result->secondUsername }}</div>

                        </div>

                    </a>

                </div>

            @endif
        @endforeach
    </div>

</html>