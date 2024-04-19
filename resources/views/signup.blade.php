<html class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up For Goongram!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="resources/css/bootstrap.css" rel="stylesheet">
    <style>
    body{
        background-image: url('https://wallpapercave.com/wp/wp2757874.gif');
            background-size: cover;

        }
    .bg-danger {
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        background-color: transparent !important;
    }
    .table {
            border: none;
    }
    .full-height {
        height: 100vh;
        width: 100%
        }
    .rounded-circle {
        width: 300px;
        height: 300px;
    }
    .bg-light {
        padding: 20px;
        background-color: transparent !important;
    }
    .w-75 {
        width: 75%;
    }
    .h1 {
        text-align: center;
        color: gray;
        }
    .btn {
        width: 100%;
    }
    .border{
        background-color: transparent !important;
    }
    @keyframes pulse {
        0% {
            color: red;
            text-shadow: 0 0 10px red;
        }
        50% {
            color: black;
            text-shadow: 0 0 20px black;
        }
        100% {
            color: red;
            text-shadow: 0 0 10px red;
        }
    }
    .pulsing-text {
        animation: pulse 2s infinite;
    }
    @keyframes sword {
        0% {
            text-shadow: 0 0 0 transparent;
        }
        50% {
            text-shadow: 0 0 5px #f8f5f5;
        }
        100% {
            text-shadow: 0 0 0 transparent;
        }
    }
    .sword-effect {
        animation: sword 5s linear infinite;
    }
    .text {
        font-size: 48px;
        color: #212332;
        -webkit-text-stroke: 2px #E23A39;
        animation: pulse 2s infinite;
    }
    .text-light-gray{
        color:gray
    }
    .invisible-input {
        background-color: transparent;
        color: gray;
        outline: none;
        width: 500px;
    }
    .btn-custom:hover,
    .btn-custom:focus {
        background-color: #000000;
        color: #333;
        animation: pulse 2s infinite;
    }
    .btn-custom:active {
        transform: translateY(1px);
    }
    </style>
</head>
<body class="body">

    <div class="container">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
        <div class = "bg-danger pb-5 mt-5 br-20 rounded-5 d-block mx-auto" style = "width:40%;">
            <div class = "justify-content-center d-flex align-items-center p-5">
                 <img src="{{ asset("storage/images/goonGramLogo.png") }}" style ="width:300px; height:300px;" class = "d-flex justify-content-center bg-secondary rounded-circle">
            </div>
            <div class = "w-100 d-flex justify-content-center">
                <form action = {{ url('api/signup') }} method = "POST" class = "w-75 bg-light ">
                    @csrf
                    <table class = "ffs-3 d-flex justify-content-center ">
                        <div class = "h1">
                            <h1>
                                <p class="text">
                                    SIGN UP HERE
                                </p>
                            </h1>
                        </div>
                        <tr class = "">
                            <td class = "pb-2 text-light-gray ">Email</td>
                            <td><input type="email" name = "email" class = "pb-2 small invisible-input" required placeholder=""></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2 text-light-gray">Username</td>
                            <td><input type="text" name = "username" class = "pb-2 small invisible-input" required placeholder = ""></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2 text-light-gray">Name</td>
                            <td><input type="text" name = "name" class = "pb-2 small invisible-input" required placeholder=""></td>
                        </tr>
                        <tr class = "">
                            <td class = "pb-2 text-light-gray">Password</td>
                            <td><input type="password" name = "password" class = "pb-2 small invisible-input" required placeholder = ""></td>
                        </tr>
                        <tr class = "">
                    </table>
                    <div class = "mt-4 w-100 d-flex justify-content-center">
                        <button class = "w-50 p-3 m-3 btn btn-outline-secondary btn-custom">Sign Up</button>
                    </form>
                        <button class = "w-50 p-3 m-3 btn btn-outline-secondary btn-custom" onclick="history.back()">Go Back</button>
                    </div>
            </div>
        </div>
    </div>


</body>

</html>

