<div class="card mb-4 shadow-sm">

    <div class="card-header">
        <a href="{{ route('profile',['id' => $image->user->id]) }}" class="text-decoration-none text-reset">
            @if($image->user->image)
                <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" class="md-avatar size-1 rounded-circle d-block border float-left" />
            @else
                <div class="gray md-avatar rounded-circle size-1 d-block border float-left"></div>
            @endif
            <b class="float-left ml-3 mt-2">{{ $image->user->nick }}</b>
        </a>
    </div>

    <div class="card-body p-0">
        <img class="card-img-top" src="{{ route('image.file', ['filename' => $image->image_path]) }}" />

        <div class="clearfix"></div>
        <?php $user_like = false; ?>
        @foreach($image->likes as $like)
            @if($like->user->id == Auth::user()->id)
                <?php $user_like = true; ?>
            @endif
        @endforeach
        <i data-id="{{ $image->id }}" class="fas fa-heart cursor-pointer {{ $user_like ? 'text-danger' : '' }} mr-2 ml-4 mb-2 mt-4"></i>
        @if(count($image->likes) != 0)
            <span class="text-black-50">{{ count($image->likes) }}</span>
        @endif

        <p class="card-text ml-4 mb-2 mt-2 mr-4">
            <a href="{{ route('profile',['id' => $image->user->id]) }}" class="text-decoration-none text-reset">
                <b class="card-text mr-2">{{ $image->user->nick }}</b>
            </a>
            <a href="{{ route('image.detail',['id' => $image->id]) }}" class="text-decoration-none text-reset">
                <span class="dark-grey-text">{{ $image->description }}</span>
            </a>
        </p>

        @if(count($image->comments) != 0)
            <a href="{{ route('image.detail',['id' => $image->id]) }}" class="text-decoration-none text-black-50 ml-4">
                {{ __('Ver los').' '.count($image->comments).' '.__('comentarios') }}
            </a>
        @endif

        <p class="card-text text-black-50 ml-4 mb-3 mt-3 mr-4">
            <small>{{ \FormatTime::LongTimeFilter($image->created_at) }}</small>
        </p>
    </div>

</div>
