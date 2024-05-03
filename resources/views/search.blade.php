<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <title>Search</title>
    @include('navbar')

    {{-- Search functionality --}}
    <script>
        $(document).ready(function() {
            $('.userRes').hide();
            $('.image').hide();
            $('#button-addon2').click(function(e) {
                e.preventDefault();
                var searchText = $('input[name="search"]').val();
                $(".image").hide();
                $('.userRes').each(function(){
                    if($(this).html().toLowerCase().indexOf(searchText.toLowerCase()) >= 0){
                        if($(this).hasClass("caption")){
                            $(this).next(".image").show();
                        }
                        else{
                            $(this).show();
                        }
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</head>
<body>
    {{-- SEARCH BAR --}}
    <div class="container">
        <div class="search-container">
            <form class="input-group mb-3 col-sm">
                <input type="text" class="form-control" placeholder="Search users, posts, etc..." aria-label="Search users, posts, etc..." aria-describedby="button-addon2" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>

        {{-- SHOW DATA FROM SEARCH --}}
        <div class="d-flex flex-column justify-content-start">
            <h2>Users</h2>
            <div>
                @foreach($searchUsers as $useres)
                    <div class="userRes"><a href="/otherAccount/{{ $useres->id }}">{{ $useres -> username }}</a></div>
                @endforeach
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center">
            <h2>Tags</h2>
            <div>
                @foreach($searchTags as $tagres)
                    <div class="userRes">{{ $tagres -> tagName }}</div>
                @endforeach
            </div>
        </div>
        <div class="d-flex flex-column justify-content-end">
            <h2>Posts</h2>
            <div>
                @foreach($searchPosts as $postres)
                    <div class="userRes caption">{{ $postres -> caption }}</div>
                    <div class="image"><img src="{{ asset('storage/'.$postres -> postImage) }}" style="height: 190px; width: 190px;" alt=""></div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
