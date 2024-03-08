<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Create Post</title>
    @include('navbar')
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="text-center">
        <form  action= url{{ "" }} method="POST" id="uploadForm">
            @csrf
            <div>
                <label for="">Add Image: </label>
                <input type="file" name="postImage">
            </div>
            <div>
                <label for="">Caption: </label>
                <textarea name="caption" placeholder="Whats on your mind?"></textarea>
            </div>
            <div>
                <label for="">Tags: </label>
                <textarea name="tag" placeholder="Tags?"></textarea>
            </div>
            <div>
                <input type="submit" value="add post">
            </div>


        </form>
    </div>


    <script>
    //
    var user = { auth()->user()->toJson()}
    </script>

    <script>
    //
    $(document).ready(function(){
    $("#postForm").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "get",
            url: "create_post.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.code == 400){
                    let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                    $('#res').html(error);
                } else if(response.code == 200){
                    let success = '<span class="alert alert-success">'+response.msg+'</span>';
                    $("#res").html(success);
                }
            }
        });
    });
});
    </script>
</body>
</html>