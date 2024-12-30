@extends('layouts.master')

@section('page_title')
    Categories
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Categories</h3>
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
                <form method="get" >
                <div class="row">
                    <div class="col-md-4" >
                        <input name="search" value="{{request('search')}}" class="form-control" type="search"
                               placeholder="Search" aria-label="Search">
                    </div>
                    <button type="submit" class="btn btn-primary"><i
                            class="fas fa-search"></i>
                    </button>
                    <div class="col-md-4">
                        <a class="btn btn-primary" href={{route('categories.create')}} ><i class="fas fa-plus"></i>Add</a>
                    </div>
                </div>
                </form>
                <br>
                @include('partials.session')
{{--                @include('flash::message')--}}
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Description</th>
                                <th scope="col" class="text-center">image</th>
                                <th scope="col" class="text-center">Edit</th>
                                <th scope="col" class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                    <td class="text-center">{{$record->name}}</td>
                                    <td class="text-center">{{$record->description}}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('uploads/'.$record->image)}}" alt="{{$record->name}}"
                                             style="height: 50px" class="img-thumbnail">
                                    </td>
                                    <td class="text-center">
                                        <a href={{route('categories.edit',$record->id)}} class=" btn btn-success
                                           btn-xs"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action={{route('categories.destroy',$record->id)}}
                                        onsubmit="return confirmDelete(event);">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $records->links('vendor.pagination.bootstrap-5') }}
                    </div>

                @endif

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection


