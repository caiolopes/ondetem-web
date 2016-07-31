@if (session()->has('message'))
    <!-- Message -->
    <div class="alert alert-success" id="message">
        <strong>{{ session('message') }}</strong>
    </div>
@endif

@if (session()->has('warning'))
    <!-- Message -->
    <div class="alert alert-warning" id="warning">
        <strong>{{ session('warning') }}</strong>
    </div>
@endif