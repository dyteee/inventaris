@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-600 bg-blue-50/90 border border-blue-200/80 shadow-[0_1px_2px_rgba(59,130,246,0.06)] transition-all duration-200 active:scale-95'
            : 'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium text-slate-600 hover:text-blue-600 hover:bg-blue-50/60 transition-all duration-200 active:scale-95';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
