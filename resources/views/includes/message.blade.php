@if( session('message') )
    <div class="alert alert-success">{{ session('message') }}</div>
@elseif( session('message-error') )
    <div class="alert alert-danger">{{ session('message-error') }}</div>
@endif
