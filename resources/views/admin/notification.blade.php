@if (session('success'))
    <div class="alert alert-success alert-dismissable">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissable">
         {{ session('error') }}
    </div>
@endif
