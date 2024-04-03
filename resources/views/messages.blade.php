<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Message Requests</title>
    @include('navbar')
</head>
<body>
    <div class="flex-column justify-content-center text-align-center">
        <div>
            <h4>Send message request: </h4>
            <div id="sended">
                
            </div>
        </div>
        <div>
            <h4>Receive message request: </h4>
            <div id="received">

            </div>
        </div>
        <div>
            <h4>Disable/Enable message requests</h4>
            <label for="disable">Disable: </label>
            <input type="radio" name="disable" value="0">
            <label for="enable">Enable: </label>
            <input type="radio" name="enable" value="1">
        </div>
    </div>
</body>
</html>