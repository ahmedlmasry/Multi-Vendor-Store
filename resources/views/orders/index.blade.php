@extends('layouts.master')
@section('page_title')
    Orders
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Orders</h3>
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
                <form method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input name="search" value="{{request('search')}}" class="form-control "
                                   type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i
                                    class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                @include('partials.session')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Note</th>
                                <th scope="col">State</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Address</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->client->name}}</td>
                                    <td>{{$record->note}}</td>
                                    <td>
                                        <div class="badge badge-secondary">
                                            {{$record->status}}</div>
                                    </td>
                                    <td>{{$record->total_price}}</td>
                                    <td>{{$record->address}}</td>
                                    <td>{{$record->created_at->format('M d,Y')}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{route('orders.show',$record->id)}}">show</a>
                                    </td>
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

