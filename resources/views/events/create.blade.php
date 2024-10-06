<x-app-layout>
    @section('styles')
    @vite(['resources/css/event.css'])
    @endsection
    <div class="container mx-auto p-4" style="width: 50%;">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <!-- 画像アップロード -->
            <div class="mb-6">
                <label for="image" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">イベント画像:</label>
                <input type="file" id="image" name="image" onchange="previewImage(event);" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <!-- ここに画像がプレビューされます -->
                <img id="image_preview" src="" alt="Image Preview" class="hidden mt-4 w-full h-auto">
            </div>

            <!-- イベント情報入力 -->
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <label for="title" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">イベント名:</label>
                    <input type="text" id="title" name="title" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- カテゴリー選択 -->
                <div class="mb-6 flex items-center mb-0">
                    <label class="block mr-4 text-sm font-bold text-gray-900 dark:text-gray-300">カテゴリー:</label>
                    @foreach($categories as $category)
                    <div class="flex items-center mr-2">
                        <input id="category_{{ $category->category_id }}" type="checkbox" value="{{ $category->category_id }}" name="category_id[]" class="mr-1">
                        <label for="category_{{ $category->category_id }}" class="text-sm text-gray-600">{{ $category->name }}</label>
                    </div>
                    @endforeach
                    @error('category_id')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                    @error('category_id.*')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <!-- 地域選択 -->
                <div class="col-span-1 w-1/4">
                    <label for="region_id" class="block mb-2 text-sm font-bold text-gray-900">地域:</label>
                    <select id="region_id" name="region_id" class="form-select block w-full text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">未設定</option> <!-- 未設定オプションの追加 -->
                        @foreach ($regions as $region)
                        <option value="{{ $region->region_id }}">{{ $region->name }}</option> <!-- region_idに修正 -->
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="date" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">開催日:</label>
                    <input type="date" id="date" name="date" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4">
                </div>

                <!-- 開始時間と終了時間 -->
                <div class="col-span-1 grid grid-cols-2 gap-6 w-1/2">
                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">開始時間:</label>
                        <input type="time" id="start_time" name="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="end_time" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">終了時間:</label>
                        <input type="time" id="end_time" name="end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="venue_name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">会場名:</label>
                    <input type="text" id="venue_name" name="venue_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div class="col-span-1">
                    <label for="venue_address" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">会場住所:</label>
                    <input type="text" id="venue_address" name="venue_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div class="col-span-1">
                    <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">説明:</label>
                    <textarea id="description" name="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>

                <div class="col-span-1">
                    <label for="reference_url" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">参考URL:</label>
                    <input type="url" id="reference_url" name="reference_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- タグのチェックボックス -->
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">タグ:</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($tags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" id="tag_{{ $tag->tag_id }}" name="tags[]" value="{{ $tag->tag_id }}" class="form-checkbox h-4 w-4 text-blue-600">
                            <label for="tag_{{ $tag->tag_id }}" class="ml-2">{{ $tag->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- 公開範囲の選択 -->
                <div class="mb-6 mt-4">
                    <label for="visibility" class="block mb-2 text-sm font-bold text-gray-900">公開範囲:</label>
                    <div class="flex items-center">
                        <input type="radio" id="draft" name="visibility" value="0" class="mr-2" {{ old('visibility', 0) == 0 ? 'checked' : '' }}>
                        <label for="draft" class="mr-4">下書き</label>

                        <input type="radio" id="pending" name="visibility" value="1" class="mr-2" {{ old('visibility') == 1 ? 'checked' : '' }}>
                        <label for="pending" class="mr-4">仮登録</label>

                        <input type="radio" id="public" name="visibility" value="2" class="mr-2" {{ old('visibility') == 2 ? 'checked' : '' }}>
                        <label for="public">全公開</label>
                    </div>
                    @error('visibility')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-1">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">イベントを登録する</button>
                </div>
            </div>
        </form>
        <script>
            function previewImage() {
                const input = document.getElementById('image');
                const preview = document.getElementById('image_preview');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = "";
                    preview.classList.add('hidden');
                }
            }
        </script>
    </div>
</x-app-layout>
