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
            <div class = "border p-3 m-2">

                {{-- data loaders --}}
                <div name = "id" class = " userID invisible">{{ $post->id }}</div> 
                <div name = "postID"class = " postID invisible">{{ $post->postID }}</div>
                
                <div class = "d-flex">

                    <a href = "/otherAccount/{{ $post->id }}">
                        <img id = "profilePicture" name = "profilePicture" style = "height:50px; width:50px;" src="
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
                        <a class = "comment-button" href = "/comments/{{ $post->postID }}">
                            <ion-icon name="chatbubble-ellipses-outline" id = "commentIcon" style = "width:35px; height:35px" class = "p-1"></ion-icon>
                        </a>
                    </div>

                    <div class = "likeCount p-2">{{ $post->likeCount }} Likes</div>
                </div>

            </div>
            
        @endforeach

    </div>

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
        });
    </script>

</body>
</html>