@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-sm text-danger text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <span>{{ $message }}</span>
        @endforeach
    </div>
@endif
