<!DOCTYPE html>
<html lang="en" class="h-100 w-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="h-100 w-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <div class="pb-5 mt-5 br-20 rounded-5 d-block mx-auto">

      <div class="w-100 d-flex justify-content-center align-items-center">

        @if($errors->any())
            <div class = "">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class = "">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action={{ url('/login ') }} method="POST" class="d-flex justify-content-center flex-column align-items-center">

            @csrf

            <h2 class="">GoonGram</h2>
            
            <div class="">
                <input type="text" id="userName-field" placeholder="Email" name="email">
            </div>

            <div class="">
                <input type="password" id="password-field" placeholder="Password" name="password">
            </div>

            <div class=""> 
                <button type = "submit">Login</button>
            </div>

            <div class="">
                Don't have an account? <a href={{ url('/signup') }}>Sign up</a>  
            </div>

        </form>

      </div>

  </div>
</body>
</html>