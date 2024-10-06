<x-app-layout>
    @section('styles')
    @vite(['resources/css/event.css'])
    @endsection

    <div class="container mx-auto p-4" style="width: 50%;">
        <!-- フライヤー画像 -->
        <div class="mb-6">
            @if ($event->image_url)
            <!-- リサイズされた画像を表示 -->
            <img src="{{ $event->image_url }}" alt="Event Image" class="w-128 h-auto object-contain mx-auto">
            @else
            <p class="">画像が設定されていません</p>
            @endif
        </div>

        <!-- イベント情報表示 -->
        <div class="grid grid-cols-1 gap-6">
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">イベント名:</label>
                <p class="">{{ $event->title }}</p>
            </div>

            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">説明:</label>
                <p class="">{{ $event->description ?? '' }}</p>
            </div>

            <!-- 地域表示 -->
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">地域:</label>
                <p class="">{{ $event->region ? $event->region->name : '' }}</p>
            </div>

            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">開催日:</label>
                <p class="">{{ $event->date ? date('Y-m-d', strtotime($event->date)) : '' }}</p>
            </div>

            <!-- 開始時間と終了時間表示 -->
            <div class="col-span-1 grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">開始時間:</label>
                    <p class="">{{ $event->start_time ? date('H:i', strtotime($event->start_time)) : '' }}</p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">終了時間:</label>
                    <p class="">{{ $event->end_time ? date('H:i', strtotime($event->end_time)) : '' }}</p>
                </div>
            </div>

            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">会場名:</label>
                <p class="">{{ $event->venue_name ?? '' }}</p>
            </div>

            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">会場住所:</label>
                <p class="">{{ $event->venue_address ?? '' }}</p>
            </div>

            <div class="col-span-1">
                <label class="block mb-2 text-sm font-bold text-gray-900 label-with-border">LINK:</label>
                <a href="{{ $event->reference_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 visited:text-purple-600">{{ $event->reference_url ?? '' }}</a>
            </div>

            <div class="col-span-1">
                <a href="{{ route('events.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">戻る</a>
            </div>
        </div>
    </div>
</x-app-layout>
