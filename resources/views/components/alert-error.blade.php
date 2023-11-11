@if ($errors->any())
<div class="alert_danger alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>Error</strong> - @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif