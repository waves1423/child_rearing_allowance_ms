<x-app-layout>
    <x-slot name="header" :recipient="$recipient">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <button type="button" onclick="location.href='{{ route('admin.recipients.show', ['recipient' => $recipient->id]) }}'" class=" bg-gray-200 border-0 py-2 px-8 mr-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          所得計算：{{ $recipient->spouse->name }}
      </h2>
    </x-slot>

    <div class="py-8">
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <form method="POST" action="{{ route('admin.recipients.spouses.calculations.update', ['recipient' => $recipient->id, 'spouse' => $recipient->spouse->id, 'calculation' => $recipient->spouse->calculation->id]) }}">
        @csrf
        @method('put')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
          <div class="flex-1 mr-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
              <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font relative">
                  <div class="flex flex-col text-center w-full mb-4">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">扶養親族</h1>
                  </div>
                  <div class="lg:w-2/3 md:w-2/3 mx-auto">
                    <div class="-m-2">
                      <div class="p-2 mx-auto">
                        <div class="relative">
                          <label for="total" class="leading-7 text-sm text-gray-600">合計人数</label>
                          <input type="number" id="total" name="total" value="{{ old('total', $recipient->spouse->calculation->dependent->total) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 mx-auto">
                        <div class="relative">
                          <label for="elder" class="leading-7 text-sm text-gray-600">うち老人扶養親族</label>
                          <input type="number" id="elder" name="elder" value="{{ old('elder', $recipient->spouse->calculation->dependent->elder) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 mx-auto">
                        <div class="relative">
                          <label for="special" class="leading-7 text-sm text-gray-600">うち特定扶養親族</label>
                          <input type="number" id="special" name="special" value="{{ old('special', $recipient->spouse->calculation->dependent->special) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 mx-auto">
                        <div class="relative">
                          <label for="year_old_16to18" class="leading-7 text-sm text-gray-600">うち16歳以上19歳未満の扶養親族</label>
                          <input type="number" id="year_old_16to18" name="year_old_16to18" value="{{ old('year_old_16to18', $recipient->spouse->calculation->dependent->year_old_16to18) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 mx-auto">
                        <div class="relative">
                          <label for="other_child" class="leading-7 text-sm text-gray-600">その他扶養する子供</label>
                          <input type="number" id="other_child" name="other_child" value="{{ old('other_child', $recipient->spouse->calculation->dependent->other_child) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                    <div class="lg:w-2/3 md:w-2/3 mx-auto">
                      <div class="-m-2">
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="income" class="leading-7 text-sm text-gray-600">所得金額</label>
                            <input onkeyup="deducted_income()" type="number" id="income" name="income" value="{{ old('income', $recipient->spouse->calculation->income->income) }}" required placeholder="円 ※10万円控除前の金額を入力して下さい" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="type" class="leading-7 text-sm text-gray-600">種別</label>
                            <select id="type" name="type" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              @foreach ($income_type_categories as $income_type_category)
                                <option value="{{ $income_type_category->value }}" @if($income_type_category->value === $recipient->spouse->calculation->income->type) selected @endif>
                                  {{ $income_type_category->type() }}
                                </option>
                              @endforeach
                            </select>                                             
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得金額</label>
                            <div id="deducted_income" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
              <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font relative">
                  <div class="container px-5 mx-auto">
                    <div class="flex flex-col text-center w-full mb-4">
                      <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">控除</h1>
                    </div>
                    <div class="lg:w-2/3 md:w-2/3 mx-auto">
                      <div class="-m-2">
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="disabled" class="leading-7 text-sm text-gray-600">障がい者控除</label>
                            <input type="number" id="disabled" name="disabled" value="{{ old('disabled', $recipient->spouse->calculation->deduction->disabled) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="specially_disabled" class="leading-7 text-sm text-gray-600">特別障がい者控除</label>
                            <input type="number" id="specially_disabled" name="specially_disabled" value="{{ old('specially_disabled', $recipient->spouse->calculation->deduction->specially_disabled) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="singleparent_or_workingstudent" class="leading-7 text-sm text-gray-600">ひとり親または勤労学生控除</label>
                            <input type="number" id="singleparent_or_workingstudent" name="singleparent_or_workingstudent" value="{{ old('singleparent_or_workingstudent', $recipient->spouse->calculation->deduction->singleparent_or_workingstudent) }}" required placeholder="人" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="special_spouse" class="leading-7 text-sm text-gray-600">配偶者特別控除</label>
                            <input type="number" id="special_spouse" name="special_spouse" value="{{ old('special_spouse', $recipient->spouse->calculation->deduction->special_spouse) }}" required placeholder="円" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="medical_expense" class="leading-7 text-sm text-gray-600">医療費控除</label>
                            <input type="number" id="medical_expense" name="medical_expense" value="{{ old('medical_expense', $recipient->spouse->calculation->deduction->medical_expense) }}" required placeholder="円" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="small_enterprise" class="leading-7 text-sm text-gray-600">小規模企業共済</label>
                            <input type="number" id="small_enterprise" name="small_enterprise" value="{{ old('small_enterprise', $recipient->spouse->calculation->deduction->small_enterprise) }}" required placeholder="円" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="other" class="leading-7 text-sm text-gray-600">その他控除</label>
                            <input type="number" id="other" name="other" value="{{ old('other', $recipient->spouse->calculation->deduction->other) }}" required placeholder="円" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>
                        <div class="p-2 mx-auto">
                          <div class="relative">
                            <label for="common" class="leading-7 text-sm text-gray-600">基礎控除</label>
                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              80,000円</div>
                          </div>
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
                    <div class="p-2 w-full flex justify-evenly mt-4">
                      <button type="button" onclick="location.href='{{ route('admin.recipients.show', ['recipient' => $recipient->id]) }}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                      <button type="submit" class="bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">計算する</button>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script>
      'use strict'
      let type = document.getElementById('type');

      window.addEventListener('DOMContentLoaded', function(){
        deducted_income();
      });

      type.addEventListener('change', function(){
        deducted_income();
      });

      function deducted_income(){
        let income = document.getElementById('income').value;
        if(type.value == 1 || type.value == 2){
          let deducted_income = income - 100000;
          if(deducted_income < 0){
            deducted_income = 0
          }
          document.getElementById('deducted_income').innerHTML = deducted_income.toLocaleString();
        } else {
          let deducted_income = Number(income);
          document.getElementById('deducted_income').innerHTML = deducted_income.toLocaleString();
        }
      }
    </script>
  </x-app-layout>