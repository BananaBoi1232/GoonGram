<!DOCTYPE html>
<html lang="en" class = "h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Sign Up For Goongram!</title>
</head>
<body class = "h-100 w-100 justify-content-center d-flex align-items-center bg-warning" style = "font-family:Verdana">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class = "w-75 h-100">
        <div class = "bg-danger pb-5 mt-5 br-20 rounded-5 d-block mx-auto" style = "width:60%;">
            <div class = "justify-content-center d-flex align-items-center p-5">
                <img src="{{ asset("storage/images/goonGramLogo.png") }}" style ="width:300px; height:300px;" class = "bg-secondary rounded-circle">
            </div>
            <div class = "w-100 d-flex justify-content-center">
                <form action = {{ url('api/signup') }} method = "POST" class = "w-75 bg-light border rounded-4 p-5">
                    @csrf
                    <table class = "fs-3 d-flex justify-content-center align-middle bg-secondary p-2 border rounded-3">
                        <div class = "d-flex justify-content-center align-items-center pb-4">
                            <h1>Sign Up Here</h1>
                        </div>
                        <tr class = "">
                            <td class = "pb-2">Email</td>
                            <td><input type="email" name = "email" class = "pb-2 small" required placeholder="example@example.com"></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2">Username</td>
                            <td><input type="text" name = "username" class = "pb-2 small" required placeholder = "Username"></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2">Name</td>
                            <td><input type="text" name = "name" class = "pb-2 small" required placeholder="Name"></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2">Password</td>
                            <td><input type="password" name = "password" class = "pb-2 small" required placeholder = "Password"></td>
                        </tr>
                        <tr class = "">
                    </table>
                    <div class = "mt-4 w-100 d-flex justify-content-center">
                        <button class = "w-50 p-3 m-3 btn btn-outline-secondary">Sign Up</button>
                </form>
                        <button class = "w-50 p-3 m-3 btn btn-outline-secondary" onclick="history.back()">Go Back</button>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>