<!DOCTYPE html>
<html class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up For Goongram!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body class="body">
    <div class="container">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
        <div class="bg-danger mt-5">
            <div class="d-flex align-items-center p-5">
                 <img src="{{ asset("storage/images/goonGramLogo.png") }}" style="width:200px; height:200px;" class="rounded-circle mx-auto">
            </div>
            <div class="text-center">
                <p class="text">Create an Account</p>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <form action={{ url('api/signup') }} method="POST" class="w-785 bg-light p-4 rounded">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" required placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" required placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" required placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" required placeholder="Password">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button class="btn btn-outline-secondary btn-custom me-md-2" type="submit">Sign Up</button>
                        <button class="btn btn-outline-secondary btn-custom" type="button" onclick="history.back()">Go Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
