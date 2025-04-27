<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')
    <div class="d-flex">
        @include('partials.sidebar')
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
