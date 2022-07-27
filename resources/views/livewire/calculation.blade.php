<div class="py-8">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="POST" action="{{ route('admin.recipients.calculations.store', ['recipient' => $recipient->id]) }}">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="flex-1 mr-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="flex flex-col text-center w-full mb-4">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">扶養親族</h1>
                            </div>
                            <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="total" class="leading-7 text-sm text-gray-600">合計人数</label>
                                            <input type="number" id="total" name="total" value="{{ old('total') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="elder" class="leading-7 text-sm text-gray-600">うち老人扶養親族</label>
                                            <input type="number" id="elder" name="elder" value="{{ old('elder') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="special" class="leading-7 text-sm text-gray-600">うち特定扶養親族</label>
                                            <input type="number" id="special" name="special" value="{{ old('special') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="year_old_16to18" class="leading-7 text-sm text-gray-600">うち16歳以上19歳未満の扶養親族</label>
                                            <input type="number" id="year_old_16to18" name="year_old_16to18" value="{{ old('year_old_16to18') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="other_child" class="leading-7 text-sm text-gray-600">その他扶養する子供</label>
                                            <input type="number" id="other_child" name="other_child" value="{{ old('other_child') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="flex flex-col text-center w-full mb-4">
                                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">所得</h1>
                                </div>
                                <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                    <div class="-m-2">
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="income" class="leading-7 text-sm text-gray-600">所得金額</label>
                                                <input type="number" id="income" name="income" value="{{ old('income') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="type" class="leading-7 text-sm text-gray-600">種別</label>
                                                <select id="sex" name="sex" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach ($income_type_categories as $income_type_category)
                                                        <option value="{{ $income_type_category->value }}">
                                                            {{ $income_type_category->type() }}
                                                        </option>
                                                    @endforeach
                                                </select>                                             
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得金額</label>
                                                <input type="number" id="deducted_income" name="deducted_income" value="{{ old('deducted_income') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="support_payment" class="leading-7 text-sm text-gray-600">養育費</label>
                                                <input type="number" id="support_payment" name="support_payment" value="{{ old('support_payment') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 mx-auto">
                                            <div class="relative">
                                                <label for="deducted_support_payment" class="leading-7 text-sm text-gray-600">控除後養育費</label>
                                                <input type="number" id="deducted_support_payment" name="deducted_support_payment" value="{{ old('deducted_support_payment') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="flex-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-4">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">控除</h1>
                            </div>
                            <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                <div class="-m-2">
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="disabled" class="leading-7 text-sm text-gray-600">障がい者控除</label>
                                            <input type="number" id="disabled" name="disabled" value="{{ old('disabled') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="specially_disabled" class="leading-7 text-sm text-gray-600">特別障がい者控除</label>
                                            <input type="number" id="specially_disabled" name="specially_disabled" value="{{ old('specially_disabled') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="singleparent_or_workingstudent" class="leading-7 text-sm text-gray-600">ひとり親または勤労学生控除</label>
                                            <input type="number" id="singleparent_or_workingstudent" name="singleparent_or_workingstudent" value="{{ old('singleparent_or_workingstudent') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="special_spouse" class="leading-7 text-sm text-gray-600">特別配偶者控除</label>
                                            <input type="number" id="special_spouse" name="special_spouse" value="{{ old('special_spouse') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="small_enterprise" class="leading-7 text-sm text-gray-600">小規模企業共済</label>
                                            <input type="number" id="small_enterprise" name="small_enterprise" value="{{ old('small_enterprise') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="other" class="leading-7 text-sm text-gray-600">その他控除</label>
                                            <input type="number" id="other" name="other" value="{{ old('other') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 mx-auto">
                                        <div class="relative">
                                            <label for="common" class="leading-7 text-sm text-gray-600">基礎控除</label>
                                            <input type="number" id="common" name="common" value="{{ old('common') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            </div>
        </div>
    </form>
</div>