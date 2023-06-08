@if(Session::has('verify-success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('verify-success') }}
</div>
@endif

@if(Session::has('verify-error'))
<div class="alert alert-info" role="alert">
    {{ Session::get('verify-error') }}
</div>
@endif