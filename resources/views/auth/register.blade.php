<x-app-layout>
    @section('styles')
    @vite(['resources/css/auth.css'])
    @endsection

    <div class="auth-page">
        <!-- 登録フォーム -->
        <div class="bg-white bg-opacity-80 rounded-lg shadow-lg p-10 max-w-lg w-full mx-auto">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- 名前 -->
                <div>
                    <x-input-label for="name" :value="__('名前')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- メールアドレス -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- パスワード -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('パスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- パスワード確認 -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('既に登録済みですか？') }}
                    </a>

                    <x-primary-button class="ms-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        {{ __('登録') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
