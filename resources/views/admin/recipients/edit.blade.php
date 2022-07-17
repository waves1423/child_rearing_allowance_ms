<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            基本情報編集：{{ $recipient->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <x-flash-message status="session('status')" />
                    <form method="POST" action="{{ route('admin.recipients.update', ['recipient' => $recipient->id]) }}">        
                        @csrf
                        @method('put')
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="number" class="leading-7 text-sm text-gray-600">三児扶</label>
                                <input type="text" id="number" name="number" value="{{ old('number', $recipient->number) }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                <input type="text" id="name" name="name" value="{{ $recipient->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="sex" class="leading-7 text-sm text-gray-600">性別</label>
                                <input type="text" id="sex" name="sex" value="{{ $recipient->sex }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="birth_date" class="leading-7 text-sm text-gray-600">生年月日</label>
                                <input type="text" id="birth_date" name="birth_date" value="{{ $recipient->birth_date }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="adress" class="leading-7 text-sm text-gray-600">住所</label>
                                <input type="text" id="adress" name="adress" value="{{ $recipient->adress }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="allowance_type" class="leading-7 text-sm text-gray-600">受給区分</label>
                                <input type="text" id="allowance_type" name="allowance_type" value="{{ $recipient->allowance_type }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="is_submitted" class="leading-7 text-sm text-gray-600">現況届</label>
                                <input type="text" id="is_submitted" name="is_submitted" value="{{ $recipient->is_submitted }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="additional_document" class="leading-7 text-sm text-gray-600">追加必要書類</label>
                                <input type="text" id="additional_document" name="additional_document" value="{{ $recipient->additional_document }}" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="is_public_pentioner" class="leading-7 text-sm text-gray-600">公的年金受給</label>
                                <input type="text" id="is_public_pentioner" name="is_public_pentioner" value="{{ $recipient->is_public_pentioner }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="note" class="leading-7 text-sm text-gray-600">特記事項</label>
                                <textarea id="note" name="note" rows="4" class="w-full bg-gray-100 bg-opacity-50 rounded border focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $recipient->note }}</textarea>
                                </div>
                            </div>

                            <div class="p-2 w-full flex justify-evenly mt-4">
                                <button type="button" onclick="location.href='{{ route('admin.recipients.show', ['recipient' => $recipient->id]) }}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
