<x-app-layout>
    <table class="table-auto">
        <tr>
            <th>ID</th>
            <th>タグ名</th>
        </tr>
        @foreach ($tags as $tag)
        <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
        </tr>
        @endforeach
        <tr>
            <td>新規タグ</td>
            <td>
                <form action="{{ route('tag.store') }}" method="post">
                    @csrf
                    <input type="text" name="name" value="{{ old('name') }}">
                    <button type="submit" class="btn">登録</button>
                </form>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </td>
        </tr>
    </table>
</x-app-layout>
