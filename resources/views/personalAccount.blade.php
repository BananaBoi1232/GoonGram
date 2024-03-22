<!DOCTYPE html>
<html lang="en" class="w-100 h-100">
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
    <div class = "d-flex justify-content-center flex-column">
        <div class="d-flex">
            <div class="">
                @php($profilePicture = $user->profilePicture)
                <img draggable="false" id = "profilePicture" name = "profilePicture" style = "height:350px; width:350px;" 
                    src="@if($profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                            @else {{ asset('storage/'.$profilePicture) }}
                @endif">
            </div>
            <div class="d-flex flex-column p-2">
                <div>
                    <h1>{{ $user->username }}</h1>
                </div>
                <div class = "d-flex flex-row">
                    <div style = "font-size:16px">{{ $user->followerCount }} followers</div>
                    <div class = "ps-4" style = "font-size:16px">{{ $user->followingCount }} following</div>
                </div>
                <div>
                    <textarea style="height:250px; width:600px; resize:none; border:none; outline:none;" class = "pt-4" readonly>{{ $user->bio }}</textarea>
                </div>
            </div>
        </div>

        <hr>

        <div d-flex class = "flex-column justify-content-center text-align-center">
            <div class = "d-flex justify-content-center text-align-center">
                <h2>posts</h2>
            </div>

                <div class = "d-flex flex-row flex-wrap">
                    @foreach($posts as $post)
                            <img draggable="false" src = "{{ asset('storage/'.$post->postImage) }}" style = "height:190px; width:190px;" class = "p-1" data-bs-toggle="modal" data-bs-target="#image{{ $post->postID }}">
                            <div class="modal fade" id="image{{ $post->postID }}" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <img draggable="false" src = "{{ asset('storage/'.$post->postImage) }}" style = "height:190px; width:190px;" class = "p-1">
                                            <button class="close" data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="likes">{{ $post->likeCount }} Likes</div>
                                            <div class="caption">{{ $post->caption }}</div>
                                            <div class="tags">{{ $post->tagID }}</div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>            
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    
</body>
</html>