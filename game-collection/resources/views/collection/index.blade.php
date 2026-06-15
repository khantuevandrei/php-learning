<x-layout>
    <h1>My collection</h1>

    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        @foreach ($games as $game)
        <div style="padding: 1rem; border: 1px solid">
            <h3>{{ $game->title }}</h3>
            <p>{{ $game->genre }}</p>
            <p>{{ $game->platform }}</p>
            <p>{{ $game->pivot->status }}</p>
            <p>{{ $game->pivot->rating }}</p>
            <p>{{ $game->pivot->notes }}</p>
            <a href="/collection/{{ $game->id }}/edit">Edit</a>
        </div>
        @endforeach
    </div>
</x-layout>
