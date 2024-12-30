@extends('layouts.master')
@section('page_title')
    Edit Categories
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action={{route('categories.update',$record->id)}}  method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="name">name</label>
                    <input class="form-control form-control-lg" name="name" value="{{$record->name}}" type="text"
                           aria-label=".form-control-lg example">
                    <label for="description">description</label>
                    <input class="form-control form-control-lg" name="description" value="{{$record->description}}" type="text"
                           aria-label=".form-control-lg example">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <br>
                        <input type="file" name="image"  id="imageInput">
                    </div>
                    <div class="form-group">
                        <img  id="imagePreview" src="{{asset('uploads/'.$record->image)}}" alt="{{$record->name}}"
                              style="max-width: 300px; " >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection

