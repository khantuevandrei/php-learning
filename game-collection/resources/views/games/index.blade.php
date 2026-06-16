<x-layout>
    <h1>Game Catalog</h1>

    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        @foreach ($games as $game)
        <div style="padding: 1rem; border: 1px solid">
            <h3>{{ $game->title }}</h3>
            <p>{{ $game->genre }}</p>
            <p>{{ $game->platform }}</p>
            <a href="/games/{{ $game->id }}">View</a>
            @if (in_array($game->id, $ownedGameIds))
            <p>owned</p>
            @else
            <form method="POST" action="/games/{{ $game->id }}">
                @csrf
                <button type="submit">Add</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>

    {{ $games->links() }}
</x-layout>
