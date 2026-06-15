<x-layout>
    <form method="POST" action="/collection/{{ $game->id }}">
        @csrf
        @method('PATCH')

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="wishlist" {{ $status === 'wishlist' ? 'selected' : '' }}>Wishlist</option>
            <option value="playing" {{ $status === 'playing' ? 'selected' : '' }}>Playing</option>
            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="dropped" {{ $status === 'dropped' ? 'selected' : '' }}>Dropped</option>
        </select>

        <br>

        <label for="rating">Rating:</label>
        <input
            type="number"
            name="rating"
            id="rating"
            value="{{ $rating }}">

        <br>

        <label for="notes">Notes:</label>
        <textarea name="notes" id="notes">{{ $notes }}</textarea>


        <br>

        <button type="submit">Update</button>
    </form>
</x-layout>
