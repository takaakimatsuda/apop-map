<x-app-layout>
    <div class="container mx-auto p-4" style="width: 80%;">
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

        <!-- 検索フォーム -->
        <div class="container mx-auto p-4" style="width: 80%;">
            <div class="p-4 border border-gray-300 rounded-lg shadow">
                <form action="{{ route('events.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- イベント名 -->
                        <div>
                            <label for="search" class="block font-medium text-gray-700">イベント名:</label>
                            <input type="text" id="search" name="search" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- 開催日範囲 -->
                        <div>
                            <label for="from_date" class="block font-medium text-gray-700">開催日:</label>
                            <input type="date" id="from_date" name="from_date" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <input type="date" id="to_date" name="to_date" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- 地域 -->
                        <div>
                            <label for="region" class="block font-medium text-gray-700">地域:</label>
                            <select id="region" name="region" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">すべての地域</option>
                                @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 検索ボタン -->
                    <div class="text-center mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">検索</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- イベントが存在しない場合のメッセージ -->
        @if ($events->isEmpty())
        <p class="text-center text-gray-600">イベントがありません</p>
        @else
        <!-- 上部のページングリンク -->
        <div class="text-center mb-4">
            <p>
                {{ $events->links() }}
            </p>
        </div>

        <!-- イベント一覧を3列グリッドで表示 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($events as $event)
            <!-- カード全体をリンクで囲む -->
            <a href="{{ route('events.show', $event->event_id) }}" class="border rounded-lg shadow-md p-4 bg-white block hover:bg-gray-100 transition duration-200">
                <!-- イベントの画像 -->
                <div class="mb-4">
                    <img src="{{ $event->image_url ?? 'path/to/default_image.png' }}" alt="{{ $event->title }}" class="w-full h-72 object-contain rounded-lg"> <!-- 画像の高さを48に設定 -->
                </div>
                <!-- タイトル -->
                <h3 class="text-lg font-bold text-blue-500 hover:text-blue-700">{{ trim($event->title) }}</h3>
                <!-- 日付と場所 -->
                <p class="text-sm text-gray-600 mt-2">{{ $event->date }} {{ $event->start_time }} - {{ $event->end_time }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $event->venue_name }}</p>
            </a>
            @endforeach
        </div>

        <!-- 下部のページングリンク -->
        <div class="text-center mt-6">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
