<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            受給者一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 mx-auto">
                            {{-- <x-flash-message status="session('status')" /> --}}
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('admin.recipients.create') }}'" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録する</button>
                            </div>
                          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">三児扶</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">住所</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">現況届</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">追加書類</th>
                                  <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">公的年金</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($lists as $list)
                                <tr>
                                  <td class="md:px-4 py-3">{{ $list->number }}</td>
                                  <td class="md:px-4 py-3">{{ $list->name }}</td>
                                  <td class="md:px-4 py-3">{{ $list->adress }}</td>
                                  <td class="md:px-4 py-3">{{ $list->is_submitted }}</td>
                                  <td class="md:px-4 py-3">{{ $list->additional_document }}</td>
                                  <td class="md:px-4 py-3">{{ $list->is_public_pentioner }}</td>
                                  {{-- <td class="md:px-4 py-3">
                                    <button onclick="location.href='{{ route('admin.owners.edit', ['owner' => $owner->id]) }}'" class=" text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-500 rounded">編集</button>
                                  </td>
                                  <form id="delete_{{$owner->id}}" method="POST" action="{{ route('admin.owners.destroy', ['owner' => $owner->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <td class="md:px-4 py-3">
                                      <a href="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" class=" text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                    </td>
                                  </form> --}}
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{-- {{ $owners->links() }} --}}
                          </div>
                        </div>
                      </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>