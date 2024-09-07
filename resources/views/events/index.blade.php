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

        <div class="space-y-4 max-w-5xl mx-auto" style="width: 80%;">
            @foreach ($events as $event)
            <div class="flex items-center border rounded-lg shadow-md p-4 bg-white">
                <!-- イベントの画像 -->
                <div class="flex-shrink-0 w-1/4">
                    <img src="{{ $event->image_url ?? 'path/to/default_image.png' }}" alt="{{ $event->title }}" class="w-full h-32 object-cover rounded-lg">
                </div>
                <!-- イベントの詳細情報 -->
                <div class="ml-4 w-3/4">
                    <!-- タイトルリンク -->
                    <a href="{{ route('events.show', $event->event_id) }}" class="text-xl font-bold text-blue-500 hover:text-blue-700">
                        {{ $event->title }}
                    </a>
                    <!-- 日付と場所 -->
                    <p class="text-sm text-gray-600 mt-1">
                        {{ $event->date }} @if($event->start_time) {{ $event->start_time }} @endif - {{ $event->end_time }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">{{ $event->venue_name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
