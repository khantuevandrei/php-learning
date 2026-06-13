<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
</head>

<body>
    <nav>
        <a href="/">Home</a>
        <a href="/users">Users</a>
        <a href="/users/create">New User</a>
        <a href="/articles/create">New Article</a>
        <a href="/dashboard">Dashboard</a>
    </nav>

    <hr>
    @if (session('success'))
    <div style="color:green">{{ session('success') }}</div>
    @endif

    {{ $slot }}
</body>

</html>
