@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>
                <div class="card-body">
                    <div class="row">
                        @if (isset($books) && count($books) > 0)
                        @foreach ($books as $book)
                        <div class="col-md-12 col-lg-6 col-xl-4">
                            <div class="card mb-2">
                                @if($book->image)
                                <img class="card-img-top" src="{{$book->image}}" alt="{{$book->title}}">
                                @endif
                                <div class="card-img-overlay d-flex flex-column justify-content-center">
                                    <h5 class="card-title text-white mt-5 pt-2">{{$book->title}}</h5>
                                    <p class="card-text pb-2 pt-1 text-white">
                                        {{\Illuminate\Support\Str::limit($book->description,50)}}
                                    </p>
                                    <a href="{{route('book.detail',[$book->slug])}}" class="text-white">View</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="col-md-12">
                            {{ $books->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection