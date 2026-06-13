<x-layout>
    <h1>Users</h1>

    <ul>
        @foreach ($users as $user)
        <li>
            {{ $user-> name }} ({{ $user->age }} age) -
            {{ $user->email }}

            @if ($user->articles->isNotEmpty())
            <ul>
                @foreach ($user->articles as $article)
                <li>{{ $article->title }}: {{ $article->content }}</li>
                @endforeach
            </ul>
            @endif

            @can('update', $user)
            <a href="/users/{{ $user->id }}/edit">Edit</a>
            <form action="/users/{{ $user->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            @endcan
        </li>
        @endforeach
    </ul>

</x-layout>
