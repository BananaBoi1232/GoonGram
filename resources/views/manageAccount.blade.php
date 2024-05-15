<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Account</title>
    <link rel="stylesheet" href="{{ asset('css/manageAccount.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    @include('navbar')
    <div class="container">
        <div class="form-container">
            <form id="uploadForm" method="POST" action="{{ url('/update') }}" enctype="multipart/form-data">
                @csrf
                <h4>Change Profile Picture</h4>
                <div id="res"></div>
                @php($profilePicture = $user->profilePicture)
                <img draggable="false" id="profilePicture" name="profilePicture" src="@if($profilePicture == null) {{ asset('storage/avatar-3814049_1920.png') }} @else {{ asset('storage/'.$profilePicture) }} @endif">
                <input id="fileUpload" type="file" name="image" style="display:none;">
                <label class="white-text" for="fileUpload">Select Picture</label>
                <div id="privacyOptions" class="d-flex justify-content-center align-items-center p-2">
                    <div class="p-2">
                        <input id="private" type="radio" name="private" value="1" @if($user->private == 1) checked @endif>
                        <label class="white-text" for="private">Private</label>
                        <div class="description">Only followers can see your profile</div>
                    </div>
                    <div class="p-2">
                        <input id="public" type="radio" name="private" value="0" @if($user->private == 0) checked @endif>
                        <label class="white-text" for="public">Public</label>
                        <div class="description">Anyone can see your profile</div>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center p-4">
                    <h4>Edit Your Bio</h4>
                    <textarea id="bio" name="bio" class="p-2" style="height:150px; width:100%; resize:none;">{{ $user->bio }}</textarea>
                </div>
                <div class="d-flex flex-row justify-content-center w-100 m-4">
                    <button id="btn" type="submit" class="me-2">Accept Changes</button>
                    <button type="button" onclick="window.location.href='/home'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

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
