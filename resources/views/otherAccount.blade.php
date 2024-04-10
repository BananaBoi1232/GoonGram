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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    
    <title>Other Account</title>
    @include('navbar')
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class = "d-flex justify-content-center flex-column containerF">

        {{-- data handlers --}}
        <div class = "userID invisible">{{ $user->id }}</div>

        <div class="d-flex">

            <div class="">

                @php($profilePicture = $user->profilePicture)
                <img id = "profilePicture" name = "profilePicture" style = "height:350px; width:350px;" 
                    src="@if($profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                            @else {{ asset('storage/'.$profilePicture) }}
                @endif">

            </div>

            <div class="d-flex flex-column p-2">

                <div>
                    <h1>{{ $user->username }}</h1>
                </div>

                <div class = "d-flex flex-row">
                    <div id = "followerCount" style = "font-size:16px">{{ $user->followerCount }} followers</div>
                    <div class = "ps-4" style = "font-size:16px">{{ $user->followingCount }} following</div>
                </div>

                <button id = "followBtn" class = "w-25 p-2 mt-2 followBtn">@if($followed->contains($user->id)) following @else follow @endif</button>

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
                       
                        <div class="modal fade" id="image{{ $post->postID }}">

                            <div class = "postID invisible">{{ $post->postID }}</div>


                            <div class="modal-dialog">

                                <div class="modal-content">     

                                    <div class="modal-header d-flex justify-content-center">
                                        <img draggable="false" src = "{{ asset('storage/'.$post->postImage) }}" style = "height:420px; width:420px;" class = "p-1">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="caption">{{ $post->caption }}</div>

                                        <div class="likes">
                                            <a class = "likeBtn">
                                                <ion-icon name="thumbs-up-outline" class="likeIcon p-1  @if($liked->contains($post->postID)) text-warning @endif" style = "width:35px; height:35px; color:black;"></ion-icon>
                                            </a>
                                            <div class = "likeCount"> {{ $post->likeCount }} Likes </div>
                                        </div>

                                        <div class="tags">{{ $post->tagID }}</div>

                                    </div>

                                </div>

                            </div>

                        </div>

                @endforeach

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function(){
            $(".followBtn").click(function(e){
                e.preventDefault();

                var userID = $(this).closest('.containerF').find('.userID').html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/follow',
                    data: {
                        userID: userID,
                    },
                    cache: false,
                    success: function(response){
                        if(response.action === 'follow'){
                            $(followBtn).html("unfollow");
                            $(followerCount).text(response.followerCount + " followers")
                        }else if(response.action === 'unfollow'){
                            $(followBtn).html("follow")
                            $(followerCount).text(response.followerCount + " followers")
                        }
                    }
                }); 
            });
            
            $(".likeBtn").click(function(e){
                e.preventDefault();

                var postID = $(this).closest('.modal').find('.postID').html();
                var likeCount = $(this).closest('.modal').find('.likeCount');
                var likeIcon = $(this).closest('.modal').find('.likeIcon');


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/like',
                    data: {
                        postID: postID,
                    },
                    cache: false,
                    success: function(response){
                        if(response.action === 'like'){
                            $(likeCount).text(response.likeCount + " Likes")
                            $(likeIcon).addClass('text-warning');
                        }else if(response.action === 'unlike'){
                            $(likeCount).html(response.likeCount + " Likes")
                            $(likeIcon).removeClass('text-warning');
                        }
                    }
                }); 
            });
        });
    </script>

</body>
</html>