<div id="message">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ Session::get('error') }}
        </div>
    @endif
</div>
