<x-layout>
    @if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form
        action="{{ $isEdit? '/users/' . $user->id : '/users' }}"
        method="POST">

        @csrf

        @if ($isEdit)
        @method('PUT')
        @endif

        <h2>{{ $isEdit ? 'Edit User' : 'Create User' }}</h2>

        <label for="name">Name:</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $user->name ?? '') }}">

        <br>

        <label for="password">Password:</label>
        <input
            type="password"
            name="password"
            id="password">

        <br>

        <label for="email">Email:</label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email', $user->email ?? '') }}">

        <br>

        <label for="age">Age:</label>
        <input
            type="number"
            name="age"
            id="age"
            value="{{ old('age', $user->age ?? '') }}">

        <br>

        <button type="submit">
            {{ $isEdit? 'Update' : 'Create' }}
        </button>
    </form>
</x-layout>
