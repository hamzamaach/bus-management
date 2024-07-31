<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="routes">
        @foreach ($routes as $route)
            <div class="route">
                <div class="time">{{ $route->time }}</div>
                <div class="path">
                    <span class="start">{{ $route->start }}</span>
                    <span class="left-line"></span>
                    <span class="bus-icon"><i class="fa-solid fa-van-shuttle"></i></span>
                    <span class="right-line"></span>
                    <span class="end">{{ $route->end }}</span>
                </div>
                <div class="slots">
                    <span class="slots-nb" >
                        {{ $route->slots_left }}
                    </span>
                    slot left
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
