<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Your Account</title>
    @include('navbar')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                @php($profilePicture = $user->profilePicture)
                <img id = "profilePicture" name = "profilePicture" style = "height:200px; width:200px;" 
                    src="@if($profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                         @else {{ asset('storage/'.$profilePicture) }}
                @endif">
            </div>
            <div class="col-lg-4 d-flex flex-column">
                <div>
                    {{ $user -> followerCount }}
                </div>
                <div>
                    Followers
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column">
                <div>
                    {{ $user -> followingCount }}
                </div>
                <div>
                    Following
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        Posts
    </div>
</body>
</html>