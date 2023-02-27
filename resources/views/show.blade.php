@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Book') }}</div>
        <div class="card-body">
          <div class="row">
            @if (isset($book))
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{$book->title}}</h3>
              <div class="col-12">
                <img src="{{$book->image}}" class="product-image" alt="{{$book->title}}">
              </div>

            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$book->title}}</h3>
              <p>{{$book->description}}</p>
              <hr>
              <p>{{$book->author}}</p>
              <p>{{$book->genre}}</p>
              <p>{{$book->isbn}}</p>
              <p>{{$book->published}}</p>
              <p>{{$book->publisher}}</p>
            </div>
            @endif
            <a href="{{route('book-list')}}">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection