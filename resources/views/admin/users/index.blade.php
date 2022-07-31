<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ユーザー一覧
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
                  <form method="GET" action="{{ route('admin.users.index') }}">
                    <div class="py-2">
                      <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif" class="bg-white w-64 m-2 border-b border-gray-600 rounded text-lg">
                      <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-blue-600 rounded text-lg">検索</button>
                      <button>
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-200 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-gray-400 rounded text-lg">クリア</a>
                      </button>
                      </div>
                  </form>
                  <button onclick="location.href='{{ route('admin.users.create') }}'" class="text-white bg-blue-500 border-0 py-2 px-4 m-3 focus:outline-none hover:bg-blue-600 rounded text-lg">新規登録する</button>
                </div>
                <div class="w-full mx-auto overflow-auto">
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">番号</th>
                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ユーザー名</th>
                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">編集</th>
                        <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">削除</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td class="md:px-4 py-3 border">{{ $user->id }}</td>
                        <td class="md:px-4 py-3 border">{{ $user->name }}</td>
                        <td class="md:px-4 py-3 border">{{ $user->email }}</td>
                        <td class="md:px-4 py-3 border">
                          <div class="flex justify-center items-center">
                            <button onclick="location.href='{{ route('admin.users.edit', ['user' => $user->id]) }}'" class=" text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-500 rounded">編集</button>
                          </div>
                        </td>
                        <td class="md:px-4 py-3 border">
                          <form id="delete_{{$user->id}}" method="POST" action="{{ route('admin.users.destroy', ['user' => $user->id]) }}">
                            @csrf
                            @method('delete')
                            <div class="flex justify-center items-center">
                              <a href="#" data-id="{{ $user->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除</a>
                            </div>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="flex justify-center">
                    {{ $users->appends(request()->query())->links() }}
                </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
    <script>
        function deletePost(e) {
          'use strict';
          if (confirm('本当に削除しますか?')) {
            document.getElementById('delete_' + e.dataset.id).submit(); 
          }
        }
    </script>    
  </x-app-layout>