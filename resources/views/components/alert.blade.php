<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
     @isset($icon) {{ $icon }} @endisset {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>