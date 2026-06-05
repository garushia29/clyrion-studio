@props([
    'headers' => [],
    'columns' => [],
])

<div {{ $attributes->merge(['class' => 'card overflow-hidden']) }}>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            @php($headerList = count($headers) > 0 ? $headers : $columns)
            @if (count($headerList) > 0)
                <thead class="bg-surface border-b border-surface-border">
                    <tr>
                        @foreach ($headerList as $header)
                            <th class="text-left py-3 px-4 text-gray-400 font-medium text-xs uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-surface-border">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
