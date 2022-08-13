<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(session()->has('_back_url'))
            <button type="button" onclick="location.href='{{ session('_back_url') }}'" class="bg-gray-200 border-0 py-2 px-8 mr-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
            @else
            <button type="button" onclick="location.href='{{ route('user.recipients.index') }}'" class="bg-gray-200 border-0 py-2 px-8 mr-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
            @endif
            受給者新規登録
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('user.recipients.store') }}">        
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="number" class="leading-7 text-sm text-gray-600">三児扶/三特児</label>
                                <input type="text" id="number" name="number" value="{{ old('number') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="kana" class="leading-7 text-sm text-gray-600">ふりがな</label>
                                <input type="text" id="kana" name="kana" value="{{ old('kana') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <label for="sex" class="leading-7 text-sm text-gray-600">性別</label>
                                <select id="sex" name="sex" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($sex_categories as $sex_category)
                                        <option value="{{ $sex_category->value }}">
                                            {{ $sex_category->type() }}
                                        </option>
                                    @endforeach
                                </select>                                             
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="birth_date" class="leading-7 text-sm text-gray-600">生年月日</label>
                                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="adress" class="leading-7 text-sm text-gray-600">住所</label>
                                <input type="text" id="adress" name="adress" value="{{ old('adress') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="allowance_type" class="leading-7 text-sm text-gray-600">受給区分</label>
                                <select id="allowance_type" name="allowance_type" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($allowance_categories as $allowance_category)
                                        <option value="{{ $allowance_category->value }}">
                                            {{ $allowance_category->type() }}
                                        </option>
                                    @endforeach
                                </select>                                                 
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <label for="is_submitted" class="leading-7 text-sm text-gray-600">現況届</label>
                                <div name="is_submitted" class="relative">
                                    <div>
                                        <input type="radio" name="is_submitted" value="1" class="mr-2">提出済み
                                    </div>
                                    <div>
                                        <input type="radio" name="is_submitted" value="0" class="mr-2" checked>未提出
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="additional_document" class="leading-7 text-sm text-gray-600">追加必要書類</label>
                                <input type="text" id="additional_document" name="additional_document" value="{{ old('additional_document') }}" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="is_public_pentioner" class="leading-7 text-sm text-gray-600">公的年金受給</label>
                                <div name="is_public_pentioner" class="relative">
                                    <div>
                                        <input type="radio" name="is_public_pentioner" value="1" class="mr-2">受給中
                                    </div>
                                    <div>
                                        <input type="radio" name="is_public_pentioner" value="0" class="mr-2" checked>受給していない
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="multiple_recipient" class="leading-7 text-sm text-gray-600">受給中の手当</label>
                                <select id="multiple_recipient" name="multiple_recipient" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($multiple_recipient_categories as $multiple_recipient_category)
                                        <option value="{{ $multiple_recipient_category->value }}">
                                            {{ $multiple_recipient_category->type() }}
                                        </option>
                                    @endforeach
                                </select>                                                 
                                </div>
                            </div>
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                <label for="note" class="leading-7 text-sm text-gray-600">特記事項</label>
                                <textarea id="note" name="note" rows="4" class="w-full bg-gray-100 bg-opacity-50 rounded border focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <div class="p-2 w-full flex justify-evenly mt-4">
                                <button type="button" onclick="location.href='{{ route('user.recipients.index') }}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>