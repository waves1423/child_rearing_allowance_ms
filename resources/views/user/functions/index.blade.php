<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            各種機能一覧
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 mx-auto">
                            <div class="flex justify-between mb-2">
                                <form method="GET" action="{{ route('user.functions.downloadCsv') }}">
                                    <div class="py-2">
                                        <a class="w-64 m-2 pr-6 border-gray-600 text-lg font-semibold">・受給者一覧CSVダウンロード</a>
                                        <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-4 m-1 focus:outline-none hover:bg-blue-600 rounded text-lg">ダウンロード</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>