<x-layout>
    <h1>{{ $game->title }}</h1>

    <p>{{ $game->genre }}</p>

    <p>{{ $game->platform }}</p>

    <p>{{ $game->description }}</p>

    @if ($isOwned)
    <form method="POST" action="/games/{{ $game->id }}">
        @csrf
        @method('DELETE')
        <button type="submit">Remove</button>
    </form>
    @else
    <form method="POST" action="/games/{{ $game->id }}">
        @csrf
        <button type="submit">Add</button>
    </form>
    @endif
</x-layout>
