@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Index
            </div>
            <div class="card-body">
                {{config("app.locale") }}
            </div>
        </div>
    </div>
</div>
@endsection
