<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Blocked Accounts</title>
    @include('navbar')
</head>
<body>
    <h1>Blocked Users</h1>

    <table>
        <thead>
            <tr>
                <th>Blocked User(s)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blockedUsers as $blockedUser)
                <tr>
                    <td>{{ $blockedUser->username }}</td>
                    <td>
                        <form action="{{ route('unblockUser', ['id' => $blockedUser->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Unblock</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>