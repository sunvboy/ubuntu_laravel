@if(session('error') || session('success'))
@if(session('success'))
<!-- Success Alert -->
<div class="alert_success alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong> - <?php echo session('success') ?>
</div>
@endif
@if(session('error'))
<!-- Danger Alert -->
<div class="alert_danger alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>Error</strong> - <?php echo session('error') ?>
</div>
@endif
@endif