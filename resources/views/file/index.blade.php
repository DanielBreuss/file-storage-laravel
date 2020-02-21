@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <a href="{{ route('formfile') }}" class="btn btn-primary">Upload File</a>
    </p>
  {{--  @if($error)
        <div>{{ $error }}</div>
    @endif--}}
    <div class="row">
        @foreach($files as $file)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ Storage::url($file->path)}}">
                <div class="card-body">
                 <strong class='card-title'>{{ $file->title }}</strong>
{{--                    <p class="card-text"> {{ $file->create_at->diffForHumans() }}</p>--}}
                    <form action="{{ route('deletefile', $file->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{ route('downloadfile', $file->id) }}" class="btn btn-primary">Download
                        </a>
                    </form>
                </div>
            </div>
        </div>
            @endforeach
    </div>
</div>
    @endsection
