@extends('layouts.adminlayout')

@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')
    <div id="deleteModal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title">Delete Confirmation</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"  id="cancelDelete">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <a href="{{route($name.'.create')}}" class="btn btn-success">Insert</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            @if($column!= 'password')
                            <th scope="col">{{ $column }}</th>
                            @endif
                        @endforeach
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            @foreach($columns as $column)
                                @if($column!= 'password')
                                @if($column=='path')
                                    <td>
                                        {{$row->$column}}
                                    </td>
                                @else
                                    <td>{{ $row->$column }}</td>

                                @endif
                                @endif


                            @endforeach
                            <td>
                                <a href="{{route($name.'.edit',[$row->id])}}" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger brisiAdmin" data-IdBrisi="{{$row->id}}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$data->links()}}
            </div>

        </div>
    </div>
@endsection
