<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/createPost.css') }}">
    <title>Create Post</title>

    @include('navbar')
</head>
<body>
    <form action="{{ url('/createPost') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
        @csrf
        <div>

            <div class="center-align">
                <div id="res"></div>
                <div class="post-image">
                    <h1>Select an Image</h1>
                </div>
                <img id="postImage" name="postImage">
                <div class="d-flex flex-column justify-content-center">
                    <input id="fileUpload" type="file" name="image" style="display:none;">
                    <label class="border p-2 m-2 container-dark" for="fileUpload">Select Image</label>
                </div>
            </div>

            <div class="d-flex flex-column">
                <div class="p-2 justify-content-center">
                    <h4>Caption</h4>
                    <textarea id="caption" name="caption" placeholder="What's on your mind?"></textarea>
                </div>

                <div class="p-2">
                    <h4>Tags</h4>
                    <textarea id="tag" name="tag" placeholder="Tag"></textarea>
                </div>

                <div class="p-2 center-align container-dark">
                    <button id="btn">Create Post</button>
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
                        'X-CSRF-TOKEN' : $('meta[name="csrf.token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"POST",
                    url: this.action,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        alert(response.msg)
                    },
                    error: (xhr, status, error) => {
                        alert('Error: '+ xhr.responseText);
                    }
                })
            })
        })
    </script>

</body>
</html>
