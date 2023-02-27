@extends('adminlte::page')

@section('title', 'Edit Book')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <h1>{{ __('Edit Book') }}</h1>
            </div>
        </div>
    </div>
</section>
<div class="content px-3">
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body" id="edit-book">
            <edit-book-component books-list="{{ url('api/v1/books') }}" show-book="{{ route('book.show',[$book->id]) }}"></edit-book-component>
        </div>
    </div>
    @endsection