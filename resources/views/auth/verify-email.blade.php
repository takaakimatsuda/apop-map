<x-app-layout>
    @section('styles')
    @vite(['resources/css/auth.css'])
    @endsection

    <div class="auth-page">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('ご登録ありがとうございます！利用を開始する前に、メールに送信されたリンクをクリックしてメールアドレスを確認してください。もし確認メールが届いていない場合は、もう一度お送りします。') }}
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('新しい確認リンクが、登録時に指定されたメールアドレスに送信されました。') }}
        </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        {{ __('確認メールを再送信') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('ログアウト') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
