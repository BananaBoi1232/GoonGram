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

    <title>Home Page</title>

    @include('navbar')

</head>

<body>
    <div class = "d-flex flex-column justify-content-center align-items-center">
        @foreach($posts as $post)
        @if($followed->contains($post->id) || $post->private == 0 || $post->id == auth()->user()->id)
            <div class = "border p-3 m-2">

                {{-- data loaders --}}
                <div name = "id" class = " userID invisible">{{ $post->id }}</div>
                <div name = "postID"class = " postID invisible">{{ $post->postID }}</div>

                {{-- Popover button --}}
                <div class="dropdown d-flex justify-content-end">
                    <button id="popoverButton" type="button" class="btn btn-sm" data-bs-toggle="popover" data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                          <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                        </svg>
                      </button>
                  </div>

                    </button>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportPost{{ $post->postID }}">
                    Report Post
                </button>

                <!-- Report Post Modal -->
                <div class="modal fade" id="reportPost{{ $post->postID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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

                {{-- Display Posts --}}
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

    <!-- Popover content div -->
    <ul class='dropdown-menu list-group-flush' id="popoverContent" width="400px" height="400px" aria-labelledby="dropdownMenuButton">
        <li class='dropdown-item'>
            <a class="link-dark link-underline link-underline-opacity-0" href='#'>Block User</a>
        </li>
        <li class='dropdown-item'>
            <a class="link-dark link-underline link-underline-opacity-0" href="#" id="messageUser">Message User</a>
        </li>
        <li class='dropdown-item'>
        </li>
    </ul>


    {{-- Dropdown options functionalty --}}
    <script>
        //script to block user via post(s).

        //script to send messages via User's post(s).
        document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('messageUser').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor tag
            sendMessage(); // Call the sendMessage function
        });
    });

        //script to report post(s) via post(s).
    </script>

    {{-- Popover script for function --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            //display popover when clicked
            var popover = new bootstrap.Popover(document.getElementById('popoverButton'), {
                content: document.getElementById('popoverContent').innerHTML,
                placement: 'bottom',
                html: true
            });

            var button = document.getElementById('popoverButton');

            button.addEventListener('click', function () {
                if (!popover._isOpen) { // Check if popover is not open
                    popover.show();
                }else {
                popover.hide();
                }
            });

            // Close popover when clicking outside
            document.addEventListener('click', function (event) {
                var isClickInsidePopover = button.contains(event.target);
                if (!isClickInsidePopover && popover._isOpen) {
                    popover.hide();
                }
            });
        });

        //basic function for popover to work properly
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                html: true,
                content: function() {
                return $('#popover-content').html();
                }
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

                    }
                });
            });
        });
    </script>

</body>
</html>
