<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            勉強記録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('records.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">勉強記録をつける</a>
                        <div class="my-4">
                            今月の勉強時間
                            {{ floor($this_month_total_study_time / 60) }}時間{{ $this_month_total_study_time % 60 }}分
                        </div>
                        <div class="my-4">
                            今日の勉強時間
                            {{ $todays_total_study_time }}分
                        </div>
                        <hr />
                        <div class="my-4">
                            <p class="text-xl mb-4">今日の記録</p>
                            @if (isset($records))
                                @foreach ($records as $record)
                                    <ul class="max-w-md divide-y divide-gray-200">
                                        <li class="pb-3 sm:pb-4">
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $record->created_at }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate">
                                                        {{ $record->SubCategory->name }}
                                                    </p>
                                                    <div class="border-dotted border-t-2 border-gray-200">
                                                        <p class="text-sm text-gray-500 truncate mt-1">
                                                            メモ
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate ml-1">
                                                            {{ $record->memo }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="inline-flex items-center text-base font-semibold text-gray-900">
                                                    {{ $record->minute }}分
                                                </div>
                                            </div>
                                        </li>
                                @endforeach
                                <div class="my-2">
                                    {{ $records->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
