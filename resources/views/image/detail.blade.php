@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')
                <div class="card shadow-sm mb-4">

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
                        <img class="card-img-top" src="{{ route('image.file',['filename' => $image->image_path]) }}" />

                        <div class="clearfix"></div>
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($image->user->id == Auth::user()->id)
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
                            <span class="dark-grey-text">{{ $image->description }}</span>
                        </p>

                        <p class="card-text text-black-50 ml-4 mb-4 mr-4">
                            <small>{{ \FormatTime::LongTimeFilter($image->created_at) }}</small>
                        </p>

                        <div class="form-group row mb-4">
                            <div class="col-md-11 ml-4">
                                <form action="{{ route('comment.save') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                    <p>
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="2" placeholder="{{ __('Añade un comentario...') }}" required></textarea>

                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Publicar') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if(count($image->comments) != 0)
                            <ul class="list-group list-group-flush">
                                @foreach($image->comments as $comment)
                                    <li class="list-group-item">
                                        <a href="{{ route('profile',['id' => $comment->user->id]) }}" class="text-decoration-none text-reset">
                                            @if($comment->user->image)
                                                <img src="{{ route('user.avatar',['filename' => $comment->user->image]) }}" class="md-avatar size-1 rounded-circle d-block border float-left" />
                                            @else
                                                <div class="gray md-avatar rounded-circle size-1 d-block border float-left"></div>
                                            @endif
                                        </a>
                                        <p class="card-text col-md-11 offset-md-1 mb-2">
                                            <a href="{{ route('profile',['id' => $comment->user->id]) }}" class="text-decoration-none text-reset">
                                                <b class="card-text mr-2">{{ $comment->user->nick }}</b>
                                            </a>
                                            <span class="dark-grey-text">{{ $comment->content }}</span>
                                        </p>
                                        <p class="card-text col-md-11 offset-md-1 text-black-50 mb-0 pr-0">
                                            <small>{{ \FormatTime::LongTimeFilter($comment->created_at) }}</small>
                                            @if( Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id) )
                                                <a href="{{ route('comment.delete',['id' => $comment->id]) }}" class="float-right text-reset text-decoration-none">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
