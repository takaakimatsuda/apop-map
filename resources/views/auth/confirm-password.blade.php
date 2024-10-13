<x-app-layout>
    @section('styles')
    @vite(['resources/css/auth.css'])
    @endsection

    <div class="auth-page">
        <!-- パスワード確認フォーム -->
        <div class="bg-white bg-opacity-80 rounded-lg shadow-lg p-10 max-w-lg w-full mx-auto">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('この操作を続行する前に、セキュリティのためパスワードを確認してください。') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- パスワード -->
                <div>
                    <x-input-label for="password" :value="__('パスワード')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        {{ __('確認') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
