@if (session()->has('message'))
    <!-- Message -->
    <div class="alert alert-success" id="message">
        <strong>{{ session('message') }}</strong>
    </div>
@endif