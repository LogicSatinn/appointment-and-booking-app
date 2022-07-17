<div {{ $attributes->class(['border-top px-5 py-4 min-height-70 d-md-flex align-items-center']) }} >
    <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
        <div class="ms-4">
            {{ $columnName }}
        </div>
    </div>

    <div class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
        <div class="badge btn-blue-soft me-5 font-size-sm fw-normal py-2">{{ $columnData }}</div>
    </div>
</div>
