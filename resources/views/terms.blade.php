<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('利用規約') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">利用規約</h1>

                    <p class="mb-4">本利用規約（以下「本規約」といいます）は、A-POP MAP（以下「当サービス」といいます）の利用に関して、ユーザーと当サービス運営者との間で適用されるものです。</p>

                    <h2 class="text-xl font-semibold mb-2">第1条（適用範囲）</h2>
                    <p class="mb-4">本規約は、当サービスのすべての利用に適用されます。ユーザーは、本規約に同意した上で、当サービスを利用するものとします。</p>

                    <h2 class="text-xl font-semibold mb-2">第2条（禁止事項）</h2>
                    <p class="mb-4">ユーザーは、当サービスを利用するにあたり、以下の行為を行ってはなりません。</p>
                    <ul class="list-disc ml-8 mb-4">
                        <li>法令または公序良俗に反する行為</li>
                        <li>虚偽の情報を登録する行為</li>
                        <li>他のユーザー、第三者、または当サービスに不利益、損害、不快感を与える行為</li>
                        <li>不正アクセスやクラッキングなど、システムを不正に操作する行為</li>
                        <li>その他、当サービス運営者が不適切と判断する行為</li>
                    </ul>

                    <h2 class="text-xl font-semibold mb-2">第3条（ユーザー登録の消去）</h2>
                    <p class="mb-4">当サービス運営者は、ユーザーが本規約に違反した場合や不正行為が確認された場合、事前の通知なくユーザー登録を削除することができるものとします。</p>

                    <h2 class="text-xl font-semibold mb-2">第4条（免責事項）</h2>
                    <p class="mb-4">当サービスの利用に関連して発生したいかなる損害についても、当サービス運営者は一切の責任を負わないものとします。ユーザーは、自己の責任において当サービスを利用するものとします。</p>

                    <h2 class="text-xl font-semibold mb-2">第5条（規約の変更）</h2>
                    <p class="mb-4">当サービス運営者は、必要と判断した場合には、ユーザーに通知することなく、本規約を変更することがあります。変更後の規約は、当サービス上で公開された時点で効力を生じるものとします。</p>

                    <h2 class="text-xl font-semibold mb-2">第6条（準拠法・管轄裁判所）</h2>
                    <p class="mb-4">本規約は、日本法に準拠し、解釈されるものとします。また、当サービスに関連して発生する紛争については、当サービス運営者の所在地を管轄する裁判所を第一審の専属的合意管轄とします。</p>

                    <div class="mt-6">
                        <a href="{{ route('welcome') }}" class="text-blue-600 hover:underline">TOPに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
