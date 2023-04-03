<select id="{{ $id }}" name="{{ $name }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    <option value="" hidden>サブカテゴリーを選んでください</option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>
