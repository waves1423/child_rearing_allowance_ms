<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            受給者詳細：{{ $recipient->name }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                                  <label for="number" class="leading-7 text-sm text-gray-600">三児扶</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->number }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->name }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="sex" class="leading-7 text-sm text-gray-600">性別</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->sex }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="birth_date" class="leading-7 text-sm text-gray-600">生年月日</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->birth_date }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="adress" class="leading-7 text-sm text-gray-600">住所</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->adress }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="allowance_type" class="leading-7 text-sm text-gray-600">受給区分</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->allowance_type }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="is_submitted" class="leading-7 text-sm text-gray-600">現況届</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->is_submitted }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="additional_document" class="leading-7 text-sm text-gray-600">追加必要書類</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->additional_document }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="is_public_pentioner" class="leading-7 text-sm text-gray-600">公的年金受給</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->is_public_pentioner }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="note" class="leading-7 text-sm text-gray-600">特記事項</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    {{ $recipient->note }}</div>
                                </div>
                              </div>
                              <div class="p-2 mx-auto">
                                <div class="relative">
                                  <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                  <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    0</div>
                                </div>
                              </div>

                              <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('admin.recipients.edit', ['recipient' => $recipient->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                <button type="button" onclick="location.href='{{ route('admin.recipients.index') }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">所得計算</button>
                              </div>

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
                              <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                <div class="-m-2">
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="number" class="leading-7 text-sm text-gray-600">三児扶</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->number }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->name }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="family_relationship" class="leading-7 text-sm text-gray-600">続柄</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->sex }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        0</div>
                                    </div>
                                  </div>    
    
                                  <div class="p-2 w-full flex justify-around mt-4">
                                    <button type="button" onclick="location.href='{{ route('admin.recipients.edit', ['recipient' => $recipient->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                    <button type="button" onclick="location.href='{{ route('admin.recipients.index') }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">所得計算</button>
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
                                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">扶養義務者</h1>
                              </div>
                              <div class="lg:w-10/12 md:w-2/3 mx-auto">
                                <div class="-m-2">
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="number" class="leading-7 text-sm text-gray-600">三児扶</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->number }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->name }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="family_relationship" class="leading-7 text-sm text-gray-600">続柄</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        {{ $recipient->sex }}</div>
                                    </div>
                                  </div>
                                  <div class="p-2 mx-auto">
                                    <div class="relative">
                                      <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得</label>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        0</div>
                                    </div>
                                  </div>    
    
                                  <div class="p-2 w-full flex justify-around mt-4">
                                    <button type="button" onclick="location.href='{{ route('admin.recipients.edit', ['recipient' => $recipient->id]) }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">基本情報編集</button>
                                    <button type="button" onclick="location.href='{{ route('admin.recipients.index') }}'" class=" bg-green-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">所得計算</button>
                                  </div>
    
                                </div>
                              </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
