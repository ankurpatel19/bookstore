@extends('adminlte::page')

@section('title', 'Books')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <h1>{{ __('Books') }}</h1>
            </div>
            <div class="col-6">
                <a class="btn btn-primary float-right" href="{{route('admin.books.create')}}">
                    {{ __('Add New Book') }}
                </a>
            </div>
        </div>
    </div>
</section>
<div class="content px-3">
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body" id="app-book">
            <book-component books-list="{{ url('api/v1/books') }}" edit-book="{{ route('admin.books.edit',[':bookid',':page',':searchText']) }}" remove-book="{{ route('admin.books.destroy',[':bookid']) }}" :page-number="{{$defaultPage}}" :search-word="'{{$searchTxt}}'"></book-component>
        </div>

    </div>
    @endsection