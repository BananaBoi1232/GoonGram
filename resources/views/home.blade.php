<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <title>Home Page</title>
    @include('navbar')
</head>
<body>
    <div class = "d-flex flex-column justify-content-center align-items-center">
        @foreach($posts as $post)
        @if(($followed->contains($post->id) || $post->private == 0 || $post->id == auth()->user()->id))
                <div class = "border p-3 m-2">

                    {{-- data loaders --}}
                    <div name = "id" class = " userID d-none">{{ $post->id }}</div>
                    <div name = "postID"class = " postID d-none">{{ $post->postID }}</div>

                    {{-- Dropdown selection menu --}}
                    <div class="container d-flex justify-content-end">
                        <div class="menu-container">
                          <div class="menu">
                            <i class="bi bi-three-dots menu-toggle"></i>
                                <ul class="dropdown-menu menu-drop">
                                    <a href = "/showMessages/{{ $post->id }}" class="link-dark link-underline link-underline-opacity-0 message">
                                        <li class="dropdown-item">
                                            Message
                                        </li>
                                    </a>
                                    <a href="{{ route('blockUser', ['id' => $post->id]) }}" class="link-dark link-underline link-underline-opacity-0">
                                        <li class="dropdown-item">
                                            Block User
                                        </li>
                                    </a>
                                    <a class="link-dark link-underline link-underline-opacity-0">
                                        <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportPost{{ $post->postID }}">
                                            Report Post
                                        </li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Report Post Modal -->
                    <div class="modal fade" id="reportPost{{ $post->postID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div>Please Give Us Your Reasoning Behind This Report</div>
                                    <textarea class = "reason" name = "reason" style="height:250px; width:450px; resize:none;" placeholder="ex. offensive content"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary reportPost">Report Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "d-flex">
                        <a href = "otherAccount/{{ $post->id }}">
                            <img draggable="false" id = "profilePicture" name = "profilePicture"style = "height:50px; width:50px;" class = "" src="
                                @if($post->profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }}
                                @else {{ asset('storage/'.$post->profilePicture) }}
                            @endif">
                        </a>
                        <div>
                            <div class = "p-2">{{ $post->username }}</div>
                        </div>
                    </div>
                    <div>
                        <img draggable="false" src = "{{ asset('storage/'.$post->postImage) }}" style = "height:300px; width:300px;" class = "p-1">
                    </div>
                    <div>
                        <textarea class = "m-1" style = "resize:none; border:0; outline:none;" readonly>{{ $post->caption }}</textarea>
                    </div>
                    <div class = "d-flex p-1 align-items-center">
                        <div>
                            <a class = "likeBtn">
                                <ion-icon name="thumbs-up-outline" class="likeIcon p-1  @if($liked->contains($post->postID)) text-warning @endif" style = "width:35px; height:35px; color:black;"></ion-icon>
                            </a>
                        </div>
                        <div>
                            <a href = "/comments/{{ $post->postID }}" class = "comment-button">
                                <ion-icon name="chatbubble-ellipses-outline" id = "commentIcon" style = "width:35px; height:35px" class = "p-1"></ion-icon>
                            </a>
                        </div>
                        <div class = "likeCount p-2">{{ $post->likeCount }} Likes</div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Styling for the dropdown menu --}}
    <style>
        .menu-container {
        position: relative;
        }

        .menu-toggle {
        font-size: 30px;
        cursor: pointer;
        color: #000;
        }

        .menu-drop {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        }

        .dropdown-menu {
        margin: 0;
        }

        .dropdown-item {
        font-size: 16px;
        cursor: pointer;
        }

        .dropdown-item a {
        display: block;
        padding: 0.5rem 1rem;
        color: #000;
        text-decoration: none;
        }

        .dropdown-item a:hover {
        background-color: #2e3135;
        }
    </style>

    {{-- Dropdown script functionalty--}}
    <script>
        $(document).ready(function() {
        $('.menu-container').each(function() {
            $(this).prepend('<i class=""></i>');
        });

        $('.menu-toggle').click(function(){
            $(this).toggleClass('bi bi-three-dots bi bi-dash');

            $('.menu-toggle').not(this).removeClass('bi bi-dash').addClass('bi bi-three-dots');
            $('.menu-drop').not($(this).siblings('.menu-drop')).slideUp("300");

            $(this).siblings('.menu-drop').slideToggle("300");
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(".likeBtn").click(function(e){
                e.preventDefault();

                var userID = $(this).closest('.border').find('.userID').html();
                var postID = $(this).closest('.border').find('.postID').html();
                var likeCount = $(this).closest('.border').find('.likeCount');
                var likeIcon = $(this).closest('.border').find('.likeIcon');


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

            $(".reportPost").click(function(e){
                e.preventDefault();

                var postID = $(this).closest('.border').find('.postID').html();
                var reason = $(this).closest('.border').find('.reason').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/reportPost',
                    data: {
                        postID: postID,
                        reason: reason,
                    },
                    cache: false,
                    success: function(response){
                        return alert(response.message);
                    }
                });
            });
        });
    </script>

</body>
</html>
