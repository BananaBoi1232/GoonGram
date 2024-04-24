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
    
    <title>Reported Posts</title>
    
    @include('adminNavBar')

</head>

<body>
    <div class = "px-1">
        <h1> Reported Posts </h1>
    </div>
    
    <hr>

    <div class="container align-items-center">
        <div class="row justify-content-center">
            <div class="col-auto gy-3">
                <form class="input-group mb-3 col-sm">
                    <input type="text" class="form-control" placeholder="Search users, posts, etc..." aria-label="Search users, posts, etc..." aria-describedby="button-addon2" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class = "d-flex flex-row flex-wrap">
        @foreach($reportedPosts as $post)
            <div class = "reportBorder results">
                <div class = "postID d-none">{{ $post->postID }}</div>
                <div class = "postID d-none">{{ $post->username }}</div>

                {{-- Unique Post Images --}}
                <img src = "{{ asset('storage/'.$post->postImage) }}"
                    draggable="false"  
                    style = "height:300px; width:300px;" 
                    class = "p-1" 
                    data-bs-toggle="modal" 
                    data-bs-target="#reportPost{{ $post->postID }}"
                >
                
                <!-- Report Post Modal -->
                <div class="modal fade" id="reportPost{{ $post->postID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Manage Post</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <img draggable="false" src = "{{ asset('storage/'.$post->postImage) }}" style = "height:420px; width:420px;">
                                <textarea style = "resize:none; border:0; outline:none;" readonly>caption: {{ $post->caption }}</textarea>
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary deletePost">Delete Post</button>
                                <button type="button" class="btn btn-primary sparePost">Spare Post</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function(){

            //ajax for deleting the post
            $(".deletePost").click(function(e){
                e.preventDefault();

                var postID = $(this).closest('.reportBorder').find('.postID').html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/deleteReportedPost',
                    data: {
                        postID: postID,
                    },
                    cache: false,
                    success: function(response){
                        return alert(response.message);
                    }
                }); 
            });

            //ajax for sparing the reported post
            $(".sparePost").click(function(e){
                e.preventDefault();

                var postID = $(this).closest('.reportBorder').find('.postID').html();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/spareReportedPost',
                    data: {
                        postID: postID,
                    },
                    cache: false,
                    success: function(response){
                        return alert(response.message);
                    }
                }); 
            });
        });

        //Search function
        $('#button-addon2').click(function(e) {
                e.preventDefault();
                var searchText = $('input[name="search"]').val();
                $('.results').each(function(){
                    if($(this).html().toLowerCase().indexOf(searchText.toLowerCase()) >= 0){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

    </script>

</body>
</html>