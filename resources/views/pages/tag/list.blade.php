<x-app-layout>
    <table>
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
    </table>
</x-app-layout>
