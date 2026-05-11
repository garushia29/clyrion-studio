@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-700 bg-gray-900 text-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) }}>
