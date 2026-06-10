@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success d-flex align-items-center gap-2 py-2']) }} role="alert">
        <i class="bi bi-check-circle-fill fs-6"></i>
        <div>{{ $status }}</div>
    </div>
@endif
