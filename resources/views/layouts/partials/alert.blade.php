@if ($type === 'success')
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
@elseif ($type === 'danger')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
@endif
