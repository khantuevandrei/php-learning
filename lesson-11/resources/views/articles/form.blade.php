<x-layout>
    @if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form method="POST" action="/articles">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" id="title">

        <br>

        <label for="content">Content:</label>
        <input type="text" name="content" id="content">

        <br>

        <button type="submit">Create</button>
    </form>
</x-layout>
