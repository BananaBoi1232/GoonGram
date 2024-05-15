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
    <title>Manage Users</title>
    @include('adminNavBar')
</head>
<body>
    <div class = "px-1">
        <h1> Banned Users </h1>
    </div>
    <hr>
    <div class="container align-items-center">
        <div class="row justify-content-center">
            <div class="col-auto gy-3">
                <form class="input-group mb-3 col-sm">
                    <input type="text" class="form-control" placeholder="Search users" aria-label="Search users, posts, etc..." aria-describedby="button-addon2" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class = "d-flex flex-row flex-wrap">
        @foreach($userInfo as $info)
        <div class="banBorder" data-bs-toggle='modal' data-bs-target='#user{{ $info->id }}'>
            
            <div class = "d-none results">
                <div class="d-none user results">{{ $info->username }}</div>
                <div class="d-none id results">{{ $info->id }}</div>
            </div>

            <div class="d-flex flex-column">
                <img draggable="false" id = "profilePicture" name = "profilePicture" style = "height:150px; width:150px;" 
                    src="@if($info->profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                            @else {{ asset('storage/'.$info->profilePicture) }}
                @endif">
                <div>{{ $info->username }}</div>
            </div>
        </div>

        {{-- Modal --}}
        <div id="user{{ $info->id }}" class="modal content" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ban/Unban User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-none user">{{ $info->username }}</div>
                        <div class="d-none userId">{{ $info->id }}</div>
                        <img draggable="false" 
                        src = "
                        @if($info->profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                        @else {{ asset('storage/'.$info->profilePicture) }}
                        @endif" 
                        style = "height:420px; width:420px;">
                        <textarea style = "resize:none; border:0; outline:none;" readonly>Bio: {{ $info->bio }}</textarea>
                    
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-primary ban">Ban</button>
                            <button type="button" class="btn btn-primary unBan">Unban</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function(){
            $('.ban').click(function(f){
                f.preventDefault();

                var userID = $(this).closest('.modal').find('.userId').html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/ban',
                    data: {
                        userID: userID,
                    },
                    cache: false,
                    success: function(response){
                        alert(response.message);
                    }
                }); 
            });

            $('.unBan').click(function(f){
                f.preventDefault();

                var userID = $(this).closest('.modal').find('.userId').html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/unban',
                    data: {
                        userID: userID,
                    },
                    cache: false,
                    success: function(response){
                        alert(response.message);
                    }
                }); 
            })
        });

        //Search function
        $('#button-addon2').click(function(e) {
            e.preventDefault();
            var searchText = $('input[name="search"]').val();
            $('.results').each(function(){
                if($(this).html().toLowerCase().indexOf(searchText.toLowerCase()) >= 0){
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });
    </script>

</body>
</html>