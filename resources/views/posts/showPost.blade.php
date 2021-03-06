@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">

            <div class="card d-flex flex-column p-5">
                <form action="{{ route('edit-post', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body col-sm-3">
                        <img src="{{ asset('/posts/' . $post->picture)}}" height="250px">
                    </div>

                    <div class="row g-2 my-3">
                        <div class="input-group col-md-6 flex-row justify-content-start my-3">
                            <label class="input-group-text" id="title">Title</label>
                            <input type="text" class="form-control" name="title" aria-label="title" value="@if($post->title != null){{$post->title}} @endif">
                        </div>

                        <div class="input-group col-md flex-row-6 justify-content-end my-3">
                            <label class="input-group-text" id="alt_text">Alt text</label>
                            <input type="text" class="form-control" name="alt_text" aria-label="alt_text" value="@if($post->alt_text != null){{$post->alt_text}} @endif">
                        </div>

                        <div class="input-group col-md-12 flex-row justify-content-center my-3">
                            <input class="form-control" id="image" name="picture" type="file">
                        </div>
                    </div>

                    <div class="d-flex justify-content-md-end my-3">
                        <button class="btn btn-outline-success" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
