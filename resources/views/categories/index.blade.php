<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('categories.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">カテゴリー追加</a>
                        <a href="{{ route('sub_categories.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">サブカテゴリー追加</a>
                    </div>
                    <div class="my-4">
                        @foreach ($categories as $category)
                            <h2 class="text-4xl font-extrabold">{{ $category->name }}</h2>
                            <ul class="space-y-1 max-w-md list-disc list-inside text-gray-500">
                                @foreach ($category->SubCategories as $sub_category)
                                    <li>{{ $sub_category->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
