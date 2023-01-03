<x-app-layout>
    <div x-data="{ open: false }">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                勉強記録登録
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('records.store') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="sab_catego"
                                    class="block mb-2 text-sm font-medium text-gray-900">サブカテゴリー</label>
                                <x-myComponents.select id="sub_categeory" name="sub_category_id" :options="$sub_categories" />
                            </div>
                            <div class="mb-6">
                                <label for="minute" class="block mb-2 text-sm font-medium text-gray-900">勉強時間</label>
                                <x-myComponents.input type="text" id="minute" name="minute" />
                            </div>
                            <div class="mb-2">
                                <button type="button" @click="open = true"
                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">タイマー起動</button>
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-myComponents.timer-modal />
    </div>
</x-app-layout>
