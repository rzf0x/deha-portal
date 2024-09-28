@props(['title', 'value', 'subValue', 'iconClass' => 'bi bi-circle-fill', 'textColor' => 'purple'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-body px-4 py-4-5">
        <div class="d-flex gap-3">
            <div class="d-flex justify-content-start">
                <div class="stats-icon {{ $textColor }} mb-2 d-flex align-items-center">
                    <span>
                        <i class="{{ $iconClass }} fs-4"></i>
                    </span>
                </div>
            </div>
            <div>
                <h6 class="text-muted font-semibold">{{ $title }}</h6>
                <h6 class="font-extrabold mb-0">{{ $value }} {{ $subValue }}</h6>
            </div>
        </div>
    </div>
</div>
