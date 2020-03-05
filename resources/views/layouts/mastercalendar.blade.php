<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'> --}}
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />
    {{-- <link rel="stylesheet" href="{{asset('layout/bower_components/font-awesome/css/font-awesome.min.css')}}"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
    <div id="app" class="container">
        @yield('content')
    </div>
</body>
<script src="/js/app.js"></script>
</html>