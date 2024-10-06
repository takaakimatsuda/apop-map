<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- 背景画像付きヘッダー -->
        <div class="mb-6 text-center bg-cover bg-center bg-no-repeat h-96 flex flex-col justify-center items-center" style="background-image: url('/images/background.jpg');">
            <div class="bg-white bg-opacity-80 rounded-lg shadow-lg p-10 max-w-lg w-full mx-auto"> <!-- 横長にするために max-w-lg と w-full に変更 -->
                <h1 class="text-4xl font-bold">A-POP MAP</h1>
                <p class="text-lg mt-2 text-gray-700">A-POPイベント専用検索サイト</p> <!-- 解説を追加 -->
                <div class="mt-6">
                    <a href="{{ route('events.index') }}" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">検索ページへ</a>
                </div>
            </div>
        </div>
    </div>
    <!-- カテゴリーごとのイベント表示 -->

    @php
    $categories = [
    1 => 'バトル',
    2 => 'DJ',
    3 => '練習会',
    4 => 'WS',
    ];
    $eventsByCategory = [
    1 => $battleEvents,
    2 => $djEvents,
    3 => $practiceEvents,
    4 => $wsEvents,
    ];
    @endphp

    @foreach ($categories as $categoryId => $categoryName)
    <section class="mb-12 p-4 max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">{{ $categoryName }}</h2>

        @if ($eventsByCategory[$categoryId]->isEmpty())
        <p class="text-center text-gray-500">該当するイベントがありません。</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($eventsByCategory[$categoryId] as $event)
            <a href="{{ route('events.show', $event->event_id) }}" class="border rounded-lg shadow-md p-4 bg-white block hover:shadow-lg transition-shadow duration-200">
                <!-- イベントの画像 -->
                <div class="mb-4">
                    @if ($event->image_url)
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-72 object-cover rounded-lg">
                    @else
                    <div class="w-full h-72 flex items-center justify-center bg-gray-200 rounded-lg">
                        <p class="text-gray-500">NO EVENT IMAGE</p>
                    </div>
                    @endif
                </div>
                <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                <!-- 日付と場所 -->
                @if ($event->date || $event->start_time || $event->end_time)
                <p class="text-sm text-gray-600 mt-2">
                    @if ($event->date)
                    {{ date('Y-m-d', strtotime($event->date)) }}
                    @endif
                    @if ($event->start_time && $event->end_time)
                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                    @elseif ($event->start_time)
                    {{ date('H:i', strtotime($event->start_time)) }}
                    @endif
                </p>
                @endif
                <p class="text-sm">{{ $event->venue_name }}</p>
            </a>
            @endforeach
        </div>
        @endif

        <!-- 他のカテゴリーも調べるボタン -->
        <div class="mt-6 text-center">
            <a href="{{ route('events.index', ['category_id' => $categoryId]) }}" class="px-6 py-2 bg-lime-500 text-white rounded-lg hover:bg-lime-600">
                他の「{{ $categoryName }}」も調べる
            </a>
        </div>
    </section>
    @endforeach
    </div>
</x-app-layout>
