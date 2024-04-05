<!DOCTYPE html>
<html lang="en" class="w-100 h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name = "csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Manage Account</title>

    @include('navbar')

</head>
<body onload = "loadData()">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="d-flex flex-column">
        <form class="d-flex flex-column justify-content-center align-items-center"  id="uploadForm" method = "POST" action = {{ url('/update') }} enctype="multipart/form-data">
            @csrf            
            <div class="d-flex flex-column justify-content-center align-items-center">                
                <h4 class = "m-2">Change Profile Picture</h4>

                <div id = "res"></div>
                
                @php($profilePicture = $user->profilePicture)
                <img draggable="false" id = "profilePicture" name = "profilePicture" style = "height:350px; width:350px;" 
                    src="@if($profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} 
                         @else {{ asset('storage/'.$profilePicture) }}
                @endif">

                <input id ="fileUpload" type = "file" name = "image" style = "display:none;">

                <label class = "border border-2 border-black p-2 m-2"for="fileUpload">Select Picture</label>
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center p-4">
                <h4>Edit Your Bio</h4>

                <textarea id = "bio" name="bio" class="p-2" style="height:250px; width:500px; resize:none;"></textarea>
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4>Account Privacy</h4>
                <div class = "d-flex flex-row">
                    <div class = "d-flex flex-column p-2">
                        <label>Public</label>
                        <input id = "public" type = "radio" name="private" value = 0>
                    </div>

                    <div class = "d-flex flex-column p-2">
                        <label>Private</label>
                        <input id = "private" type = "radio" name="private" value = 1>
                    </div>
                </div>
            </div>

            <div class = "d-flex flex-row justify-content-center w-50 m-4">
                <button id = "btn" type = "submit" class = "me-2">Accept Changes</button>
            </form>
            <form action = {{ "/home" }}>
                <button class = "">Cancel</button>
            </form>
        </div>    
    </div>

    <script>
        var user = {!! auth()->user()->toJson() !!};
        function loadData(){
            document.getElementById("bio").defaultValue = user["bio"];
            if(user["private"]==0){
                document.getElementById("public").checked = true;
            }
            if(user["private"]==1){
                document.getElementById("private").checked = true;
            }
        }
    </script>


    <script>

        $(document).ready(function(){
            $("#fileUpload").change(function(){
                let reader = new FileReader();
                    
                reader.onload = (e) => {
                    $("#profilePicture").attr('src', e.target.result);
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
                            $('#btn').html("Accept Changes");
                        }else if(response.code = 200){
                            let success = '<span class = "alert alert-success">'+response.msg+'</span>';
                            $("#res").html(success);
                            $('#btn').attr("disabled", false);
                            $('#btn').html("Accept Changes");
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>