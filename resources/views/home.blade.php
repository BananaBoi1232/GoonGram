<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Home Page</title>
    
    @include('navbar')

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <div class = "d-flex flex-column justify-content-center align-items-center">
        @foreach($posts as $post)

            <div style = "display:none;" id = "post" value = "{{ $post->postID }}"></div>

            <div class = "border p-3 m-2">
                <div class = "d-flex">

                    <img draggable="false" id = "profilePicture" name = "profilePicture"style = "height:50px; width:50px;" class = "" src="
                        @if($post->profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                        @else {{ asset('storage/'.$post->profilePicture) }}
                    @endif">

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
                        <button id = "likeBtn">
                            <ion-icon name="thumbs-up-outline" id="likeIcon" style = "width:35px; height:35px; color:black;" class ="p-1"></ion-icon>
                        </button>
                    </div>

                    <div>
                        <button id = "comment-button">
                            <ion-icon name="chatbubble-ellipses-outline" id = "commentIcon" style = "width:35px; height:35px" class = "p-1"></ion-icon>
                        </button>
                    </div>

                    <div class="p-2" id = "likeCount">{{ $post->likeCount }} Likes</div>
                </div>
    


            </div>  
        @endforeach

    </div>

    <script>
        $(document).ready(function(){
            $("#likeBtn").click(function(e){
                e.preventDefault();

                var postID = $("#post").val();

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
                    success: function(data){
                        alert(data);
                    }

                }); 
            });
        });
    </script>

</body>
</html>