<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      受給者一覧
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
                <form method="GET" action="{{ route('user.recipients.index') }}">
                  <div class="py-2">
                    <input type="search" placeholder="受給者名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif" class="bg-white w-64 m-2 border-b border-gray-600 rounded text-lg">
                    <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-blue-600 rounded text-lg">検索</button>
                    <button>
                      <a href="{{ route('user.recipients.index') }}" class="bg-gray-200 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-gray-400 rounded text-lg">クリア</a>
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
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">三児扶</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">現況届</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">追加書類</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">公的年金</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recipients as $recipient)
                    <tr class="hover:bg-gray-200 border" onclick="location.href='{{ route('user.recipients.show', ['recipient' => $recipient->id]) }}'">
                      <td class="md:px-4 py-3 border">{{ $recipient->id }}</td>
                      <td class="md:px-4 py-3 border">{{ $recipient->number }}</td>
                      <td class="md:px-4 py-3 border">{{ $recipient->name }}</td>
                      <td class="md:px-4 py-3 border">{{ $recipient->adress }}</td>
                      <td class="md:px-4 py-0 border">
                        @if($recipient->is_submitted === 1)
                        <div class="font-semibold m-0 text-2xl text-blue-500">☑️</div>
                        @else
                        -
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">
                        @if(isset($recipient->additional_document))
                        {{ $recipient->additional_document }}
                        @else
                        -
                        @endif
                      </td>
                      <td class="md:px-4 py-3 border">
                        @if($recipient->is_public_pentioner === 1)
                        受給中
                        @else
                        -
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="flex justify-center">
                  {{ $recipients->appends(request()->input())->links() }}
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>