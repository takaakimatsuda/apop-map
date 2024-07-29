<x-app-layout>
    <div class="container mx-auto p-4">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.828 10l-3.172 3.172a1 1 0 001.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.172 10l3.172-3.172z" />
                </svg>
            </span>
        </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border border-gray-300">ID</th>
                    <th class="px-4 py-2 border border-gray-300">タグ名</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $tag->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $tag->name }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="border border-gray-300 px-4 py-2">新規タグ</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('tag.store') }}" method="post" class="flex items-center">
                            @csrf
                            <input type="text" name="name" value="{{ old('name') }}" class="border rounded py-2 px-3 mr-2 w-full">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">登録</button>
                        </form>
                        @error('name')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
