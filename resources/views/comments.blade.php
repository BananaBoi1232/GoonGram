<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <title>Comments</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    @include('navbar')
</head>
<body>

    <div class = "d-flex justify-content-center align-items-center ">

        <div class = "invisible" id = "postID">{{ $post->postID }}</div>

        <img id = "profilePicture" name = "profilePicture" style = "height:50px; width:50px;" src="
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

    <hr>

    <div>
        <textarea style="resize:none;" id = "commentContent" placeholder = "Leave A Comment!" class = "w-100"></textarea>
        <button id = "addComment">Comment</button>
    </div>

    <div class = "d-flex justify-content-center">
        <h2> Comments</h2>
    </div>


    <div class = "d-flex flex-column w-100 border" style = "height: 350px; overflow-y: auto;">

        @foreach($comments as $comment)

        <div class = "d-flex flex-column p-3 text-align-center border m-1">

            <div class = "d-flex flex-row">

                <div>
                    <img id = "profilePicture" name = "profilePicture" style = "height:50px; width:50px;" src="
                    @if($comment->profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                    @else {{ asset('storage/'.$comment->profilePicture) }}
                    @endif">
                </div>
                
                <div>
                    <div>{{ $comment->username }}</div>
                </div>

            </div>

            <div>{{ $comment->commentContent }}</div>

        </div>

        @endforeach

    </div>
    
    <script>
        $(document).ready(function(){
            $("#addComment").click(function(e){
                e.preventDefault();

                var commentContent = $("#commentContent").val();
                var postID = $("#postID").html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/createComment',
                    data: {
                        commentContent: commentContent,
                        postID: postID,
                    },
                    cache: false,
                    error: function(data){
                        alert("Comment Cannot be empty!");
                    },
                    success: function(response){
                        alert(response.msg);
                    }
                }); 
            });
        });
    </script>

</body>

</html>