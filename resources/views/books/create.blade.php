@extends('adminlte::page')

@section('title', 'Create Book')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <h1>{{ __('Create Book') }}</h1>
            </div>
        </div>
    </div>
</section>
<div class="content px-3">
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body" id="create-book">
            <create-book-component books-list="{{ route('admin.books.index') }}" store-book="{{ url('api/v1/book') }}"></create-book-component>
        </div>
    </div>
    @endsection