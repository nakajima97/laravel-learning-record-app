@php
    $placeholder = $placeholder ?? '';
    
    $is_required = $isrequired ?? false;
    $required = $is_required ? 'required' : '';
@endphp

<input type="{{ $type }}" id="{{ $id }}" name={{ $name }}
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    placeholder="{{ $placeholder }}" {{ $required }}>
