<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(session()->has('_back_url'))
            <button type="button" onclick="location.href='{{ session('_back_url') }}'" class="bg-gray-200 border-0 py-2 px-8 mr-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
            @else
            <button type="button" onclick="location.href='{{ route('user.recipients.index') }}'" class="bg-gray-200 border-0 py-2 px-8 mr-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
            @endif
            受給者詳細：{{ $recipient->name }}
        </h2>
    </x-slot>

    <x-flash-message status="session('status')" />
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 mr-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-4">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">受給者</h1>
                            </div>
                            <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="number" class="leading-7 text-sm text-gray-600">三児扶/三特</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $recipient->number }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $recipient->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="kana" class="leading-7 text-sm text-gray-600">ふりがな</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $recipient->kana }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="sex" class="leading-7 text-sm text-gray-600">性別</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if($recipient->sex === \Sex::Male->value)
                                                {{ \Sex::Male->type() }}
                                                @else
                                                {{ \Sex::Female->type() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="birth_date" class="leading-7 text-sm text-gray-600">生年月日</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $recipient->birth_date }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="adress" class="leading-7 text-sm text-gray-600">住所</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $recipient->adress }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="allowance_type" class="leading-7 text-sm text-gray-600">受給区分</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if($recipient->allowance_type === \AllowanceType::Payment_full->value)
                                                {{ \AllowanceType::Payment_full->type() }}
                                                @elseif($recipient->allowance_type === \AllowanceType::Payment_partial->value)
                                                {{ \AllowanceType::Payment_partial->type() }}
                                                @else
                                                {{ \AllowanceType::Payment_suspended->type() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="is_submitted" class="leading-7 text-sm text-gray-600">現況届</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if($recipient->is_submitted === 1)
                                                提出済み
                                                @else
                                                未提出
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="additional_document" class="leading-7 text-sm text-gray-600">追加必要書類</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if(isset($recipient->additional_document))
                                                {{ $recipient->additional_document }}
                                                @else
                                                -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="is_public_pentioner" class="leading-7 text-sm text-gray-600">公的年金受給</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if($recipient->is_public_pentioner === 1)
                                                受給中
                                                @else
                                                受給していない
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="multiple_recipient" class="leading-7 text-sm text-gray-600">受給中の手当</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if($recipient->multiple_recipient === \MultipleRecipient::Normal_recipient->value)
                                                {{ \MultipleRecipient::Normal_recipient->type() }}
                                                @elseif($recipient->multiple_recipient === \MultipleRecipient::Special_recipient->value)
                                                {{ \MultipleRecipient::Special_recipient->type() }}
                                                @else
                                                {{ \MultipleRecipient::Dual_recipient->type() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="note" class="leading-7 text-sm text-gray-600">特記事項</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if(isset($$recipient->note))
                                                {{ $recipient->note }}
                                                @else
                                                -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @if(isset($recipient->calculation->deducted_income))
                                                {{ number_format($recipient->calculation->deducted_income) }}
                                                @else
                                                未算定
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button" onclick="location.href='{{ route('user.recipients.edit', ['recipient' => $recipient->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                        @if(isset($recipient->calculation->id))
                                        <button type="button" onclick="location.href='{{ route('user.recipients.calculations.edit', ['recipient' => $recipient->id, 'calculation' => $recipient->calculation->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                        @else
                                        <button type="button" onclick="location.href='{{ route('user.recipients.calculations.create', ['recipient' => $recipient->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                        @endif
                                    </div>
                                    @auth('admin')
                                    <x-delete-recipient :recipient="$recipient" />
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="flex-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="flex flex-col text-center w-full mb-4">
                                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">配偶者</h1>
                                </div>
                                @if(isset($recipient->spouse))
                                <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                    <div class="-m-2">
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $recipient->spouse->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="family_relationship" class="leading-7 text-sm text-gray-600">続柄</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $recipient->spouse->family_relationship }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @if(isset($recipient->spouse->calculation->deducted_income))
                                                    {{ number_format($recipient->spouse->calculation->deducted_income) }}
                                                    @else
                                                    未算定
                                                    @endif
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <button type="button" onclick="location.href='{{ route('user.recipients.spouses.edit', ['recipient' => $recipient->id, 'spouse' => $recipient->spouse->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                            @if(isset($recipient->spouse->calculation->id))
                                            <button type="button" onclick="location.href='{{ route('user.recipients.spouses.calculations.edit', ['recipient' => $recipient->id,'spouse' => $recipient->spouse->id, 'calculation' => $recipient->spouse->calculation->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                            @else
                                            <button type="button" onclick="location.href='{{ route('user.recipients.spouses.calculations.create', ['recipient' => $recipient->id, 'spouse' => $recipient->spouse->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                            @endif
                                        </div>
                                        @auth('admin')
                                        <x-delete-spouse :recipient="$recipient" />
                                        @endauth
                                    </div>
                                </div>
                                @else
                                <div class="flex justify-center">
                                    <button type="button" onclick="location.href='{{ route('user.recipients.spouses.create', ['recipient' => $recipient->id]) }}'" class=" text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">配偶者新規登録</button>
                                </div>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="flex flex-col text-center w-full mb-4">
                                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">扶養義務者</h1>
                                </div>
                                @if(isset($recipient->obligor))
                                <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                    <div class="-m-2">
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $recipient->obligor->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="family_relationship" class="leading-7 text-sm text-gray-600">続柄</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $recipient->obligor->family_relationship }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @if(isset($recipient->obligor->calculation->deducted_income))
                                                    {{ number_format($recipient->obligor->calculation->deducted_income) }}
                                                    @else
                                                    未算定
                                                    @endif
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <button type="button" onclick="location.href='{{ route('user.recipients.obligors.edit', ['recipient' => $recipient->id, 'obligor' => $recipient->obligor->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                            @if(isset($recipient->obligor->calculation))
                                            <button type="button" onclick="location.href='{{ route('user.recipients.obligors.calculations.edit', ['recipient' => $recipient->id, 'obligor' => $recipient->obligor->id, 'calculation' => $recipient->obligor->calculation->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                            @else
                                            <button type="button" onclick="location.href='{{ route('user.recipients.obligors.calculations.create', ['recipient' => $recipient->id, 'obligor' => $recipient->obligor->id]) }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">所得計算</button>
                                            @endif
                                        </div>
                                        @auth('admin')
                                        <x-delete-obligor :recipient="$recipient" />
                                        @endauth
                                    </div>
                                </div>
                                @else
                                <div class="flex justify-center">
                                    <button type="button" onclick="location.href='{{ route('user.recipients.obligors.create', ['recipient' => $recipient->id]) }}'" class=" text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">扶養義務者新規登録</button>
                                </div>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
