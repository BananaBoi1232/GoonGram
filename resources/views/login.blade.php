<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body class="bg-danger h-100 w-100">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="bg-light p-5 rounded">
                    <div class="text-center mb-5">
                        <img src="{{ asset("storage/images/goonGramLogo.png") }}" style="width: 200px; height: 200px;" class="rounded-circle mx-auto mb-4">
                        <h2><p class="text">
                            GoonGram
                        </p></h2>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" id="userName-field" class="form-control" placeholder="Email" name="email">
                        </div>

                        <div class="mb-3">
                            <input type="password" id="password-field" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-secondary btn-custom w-100">Login</button>
                        </div>
                    </form>

                    <div class="text-center">
                        <a href="{{ url('/signup') }}" class="btn btn-outline-secondary btn-custom w-100">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
