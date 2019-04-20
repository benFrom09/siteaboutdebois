<button type="submit" class="btn @isset($color){{ ' btn-' . $color }}@else abdb-form-btn @endisset float-right">
    {{ $slot }}
</button>