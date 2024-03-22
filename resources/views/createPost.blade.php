<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <title>Create Post</title>

    @include('navbar')
</head>
<body>
    <form action = {{ url('/createPost') }} method="POST" id="uploadForm" class = "d-flex flex-column justify-content-center p-2 align-items-center" enctype="multipart/form-data">
        @csrf
        <div class = "justify-content-center d-flex flex-column">

            <div class = "justify-content-center d-flex flex-column">

                <div id = "res"></div>

                <h1>Post Image</h1>
                <img id = "postImage" name = "postImage" style = "height:350px; width:350px;">

                <div class = "d-flex flex-column justify-content-center">
                    <input id ="fileUpload" type = "file" name = "image" style = "display:none;">
                    <label class = "border border-2 border-black p-2 m-2"for="fileUpload">Select Picture</label>
                </div>

            </div>

            <div>

                <div class = "d-flex p-2 flex-column">
                    <h4 class = "p-2">Caption</h4>
                    <textarea id="caption" name = "caption" placeholder="Whats on your mind?" class = "p-2" style = "resize:none;"></textarea>
                </div>

                <div class = "d-flex p-2 flex-column">
                    <h4 class = "p-2">Tags</h4>
                    <textarea id="tag" name = "tag" placeholder="Tag" class = "p-2" style = "resize:none;"></textarea>
                </div>

                <div class = "d-flex p-2 justify-content-center">
                    <button id = "btn">Create Post</button>
                </div>

            </div>

        </div>

    </form>

    <script>

        $(document).ready(function(){
            $("#fileUpload").change(function(){
                let reader = new FileReader();
                    
                reader.onload = (e) => {
                    $("#postImage").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

            })

            $("#uploadForm").submit(function(e){
                e.preventDefault();

                var formData = new FormData(this);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF.TOKEN' : $('meta[name="csrf.token"]').attr('content')
                    }
                });
                $("#btn").attr("disabled", true);
                $("#btn").html("Updating...");

                $.ajax({
                    type:"POST",
                    url: this.action,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if(response.code == 400){
                            let error = '<span class = "alert alert-danger">'+response.msg+'</span>';
                            $('#res').html(error);
                            $('#btn').attr("disabled", false);
                            $('#btn').html("Create Post");
                        }else if(response.code = 200){
                            let success = '<span class = "alert alert-success">'+response.msg+'</span>';
                            $("#res").html(success);
                            $('#btn').attr("disabled", false);
                            $('#btn').html("Create Post");
                        }
                    }
                })
            })
        })
    </script>

</body>
</html>