@if( Auth::user()->image )
    <img src="{{ route('user.avatar',['filename' => Auth::user()->image]) }}" class="md-avatar @isset($size) size-{{ $size }} @endisset rounded-circle mx-auto d-block shadow-sm border" />
@else
    <div class="gray md-avatar rounded-circle size-{{ $size }} mx-auto d-block shadow-sm border"></div>
@endif
