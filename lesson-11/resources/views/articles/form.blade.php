<x-layout>
    @if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form
        method="POST"
        action="{{ $isEdit? '/articles/' . $article->id : '/articles' }}">
        @csrf
        @if ($isEdit)
        @method('PUT')
        @endif

        <label for="title">Title:</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $article->title ?? '') }}">

        <br>

        <label for="content">Content:</label>
        <input
            type="text"
            name="content"
            id="content"
            value="{{ old('content', $article->content ?? '') }}">

        <br>

        <button type="submit">{{ $isEdit? 'Update' : 'Create' }}</button>
    </form>
</x-layout>
