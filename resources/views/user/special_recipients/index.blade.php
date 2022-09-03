<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      特別児童扶養手当　受給者一覧
    </h2>
  </x-slot>
  
  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">          
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <section class="text-gray-600 body-font">
            <div class="container md:px-5 mx-auto">
              <x-flash-message status="session('status')" />
              <div class="flex justify-between mb-2">
                <form method="GET" action="{{ route('user.special_recipients.index') }}">
                  <div class="py-2">
                    <input type="search" placeholder="受給者名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif" class="bg-white w-64 m-2 border-b border-gray-600 rounded text-lg">
                    <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-blue-600 rounded text-lg">検索</button>
                    <button>
                      <a href="{{ route('user.special_recipients.index') }}" class="bg-gray-200 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-gray-400 rounded text-lg">クリア</a>
                    </button>
                  </div>
                </form>
                <button onclick="location.href='{{ route('user.recipients.create') }}'" class="text-white bg-blue-500 border-0 py-2 px-4 m-3 focus:outline-none hover:bg-blue-600 rounded text-lg">新規登録する</button>
              </div>
              <div class="w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">番号</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">三児扶/三特</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">現況届</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">追加書類</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">公的年金</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">特記事項</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($special_recipients as $special_recipient)
                    <tr class="hover:bg-gray-200 border" onclick="location.href='{{ route('user.recipients.show', ['recipient' => $special_recipient->id]) }}'">
                      <td class="md:px-4 py-3 border">{{ $special_recipient->id }}</td>
                      <td class="md:px-4 py-3 border">{{ $special_recipient->number }}</td>
                      <td class="md:px-4 py-3 border">
                        {{ $special_recipient->name }}
                        @if($special_recipient->multiple_recipient === 1)
                        <span class="text-purple-400 border-solid border-2 border-purple-400 rounded ml-1">児</span>
                        @elseif($special_recipient->multiple_recipient === 2)
                        <span class="text-red-400 border-solid border-2 border-red-400 rounded ml-1">特</span>
                        @else
                        <span class="text-purple-400 border-solid border-2 border-purple-400 rounded ml-1">児</span>
                        <span class="text-red-400 border-solid border-2 border-red-400 rounded ml-1">特</span>
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">{{ $special_recipient->adress }}</td>
                      <td class="md:px-4 py-0 border">
                        @if($special_recipient->is_submitted === 1)
                        <div class="font-semibold m-0 text-2xl text-blue-500">☑️</div>
                        @else
                        -
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">
                        @if(isset($special_recipient->additional_document))
                        {{ $special_recipient->additional_document }}
                        @else
                        -
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">
                        @if($special_recipient->is_public_pentioner === 1)
                        受給中
                        @else
                        -
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">
                        @if(!empty($special_recipient->note))
                        <div class="text-red-500">有り</div>
                        @else
                        -
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="flex justify-center">
                  {{ $special_recipients->appends(request()->input())->links() }}
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>