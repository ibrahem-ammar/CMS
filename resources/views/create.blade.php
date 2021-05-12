@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="file" name="image" id="image">
                        <input type="submit" value="s">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
