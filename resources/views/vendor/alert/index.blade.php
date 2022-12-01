@if( session()->has('success') )
<!-- BEGIN: Success Notification Content -->
<div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-success" data-lucide="check-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Success!</div>
        <div class="text-slate-500 mt-1"> {!! session()->get('success') !!} </div>
    </div>
</div>
<!-- END: Success Notification Content -->
@endif

<!-- BEGIN: Failed Notification Content -->
<div id="failed-notification-content" class="toastify-content hidden flex"> <i class="text-danger" data-lucide="x-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Registration failed!</div>
        <div class="text-slate-500 mt-1"> Please check the fileld form. </div>
    </div>
</div>
<!-- END: Failed Notification Content -->
