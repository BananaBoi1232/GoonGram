<!DOCTYPE html>
<html lang="en" class="w-100 h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Manage Account</title>
</head>
<body class="w-100 h-75 d-flex justify-content-center align-items-center">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="d-flex flex-column">

        <form class="d-flex flex-column justify-content-center align-items-center" method = "POST" action = {{ url('api/signup') }}>
            @csrf
            @method('PUT')
            <div class="d-flex flex-column justify-content-center align-items-center">
                <label>Change Profile Picture</label>
                <input type = "file" name = "profilePicture" class="w-75 h-75">
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center">
                <label>Edit Your Bio</label>
                <textarea name="bio" style="height:250px; width:500px; resize:none;"></textarea>
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center">
                <label>Account Privacy</label>

                <label>Public</label>
                <input type = "radio" name="private" value="0">

                <label>Private</label>
                <input type = "radio" name="private" value="1">
            </div>

            <div>
                <button>Edit Profile</button>
        </form>
                <button onclick="history.back()">Accept Changes</button>
            </div>
    
    </div>
</body>
</html>