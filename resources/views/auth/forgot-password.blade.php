<x-app-layout>
    @section('styles')
    @vite(['resources/css/auth.css'])
    @endsection

    <div class="auth-page">
        <div class="bg-white bg-opacity-80 rounded-lg shadow-lg p-10 max-w-lg w-full mx-auto">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('パスワードをお忘れですか？問題ありません。メールアドレスを入力していただければ、パスワードリセットリンクをお送りしますので、新しいパスワードを設定してください。') }}
            </div>

            <!-- セッションステータス -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- メールアドレス -->
                <div>
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        {{ __('パスワードリセットリンクを送信') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
