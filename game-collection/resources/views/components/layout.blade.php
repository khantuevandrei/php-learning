<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="padding:1rem">
    <nav>
        <a href="/">Catalog</a>
        <a href="/dashboard">Dashboard</a>
        <a href="/collection">Collection</a>
    </nav>

    <hr>

    @if (session('success'))
    <div style="color:green">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    {{ $slot }}
</body>

</html>
