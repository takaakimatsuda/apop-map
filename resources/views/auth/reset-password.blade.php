<x-app-layout>
    @section('styles')
    @vite(['resources/css/auth.css'])
    @endsection

    <div class="auth-page">
        <!-- パスワードリセットフォーム -->
        <div class="bg-white bg-opacity-80 rounded-lg shadow-lg p-10 max-w-lg w-full mx-auto">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- パスワードリセットトークン -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- メールアドレス -->
                <div>
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- パスワード -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('パスワード')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
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
                    <x-primary-button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        {{ __('パスワードをリセット') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
