@extends('layouts.master')
@include('layouts.nav')
@section('content')
    <form class="form-horizontal" method="post" action="{{url('edit',[$post->id])}}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="_method" value="PUT">
        </div>
        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Title:</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
            </div>
        </div>

        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Body:</label>
            <div class="col-sm-10">
                <textarea type="text" name="body" class="form-control" id="body">{{$post->body}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </div>
    </form>
    <div class="form-group">
        @include('layouts.errors')
    </div>
@endsection