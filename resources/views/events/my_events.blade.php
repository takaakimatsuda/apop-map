<x-app-layout>
    <div class="container mx-auto p-4">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">成功！</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                    <title>閉じる</title>
                    <path d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.828 10l-3.172 3.172a1 1 0 001.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.172 10l3.172-3.172z" />
                </svg>
            </span>
        </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">イベント管理</h2>
            <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">イベントを作成する</a>
        </div>

        @if ($events->isEmpty())
        <p class="text-center text-gray-600">管理するイベントがありません</p>
        @else
        <!-- イベント管理一覧 -->
        <div class="bg-gray-50 border border-gray-300 rounded-lg shadow p-4">
            @foreach ($events as $event)
            <div class="flex justify-between items-center border-b border-gray-300 py-4">
                <div class="flex items-center">
                    <div class="mr-4">
                        <!-- 公開状態のラベルを明確に表示 -->
                        @if ($event->visibility == 0)
                        <span style="background-color: red; color: white; padding: 2px 8px; border-radius: 5px; font-size: 14px;">下書き</span>
                        @elseif ($event->visibility == 1)
                        <span style="background-color: yellow; color: black; padding: 2px 8px; border-radius: 5px; font-size: 14px;">ユーザー</span>
                        @else
                        <span style="background-color: green; color: white; padding: 2px 8px; border-radius: 5px; font-size: 14px;">全公開</span>
                        @endif
                    </div>
                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded mr-4">
                        @if ($event->image_url)
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover rounded">
                        @else
                        <span class="text-gray-500">No Image</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- 編集ボタン -->
                    <a href="{{ route('events.edit', $event->event_id) }}" style="background-color: green; color: white;" class="px-4 py-2 rounded">編集する</a>
                    <!-- 削除ボタン -->
                    <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">削除する</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- 下部のページングリンク -->
        <div class="text-center mt-6">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
