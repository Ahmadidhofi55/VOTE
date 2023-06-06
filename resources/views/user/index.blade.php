@extends('layouts.tables')
@section('title','USER')
@section('table','USER')
@section('contend')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" id="add_btn" data-toggle="modal" data-target="#btn_add">
                Create
            </button>
            <!-- Modal -->
            <div class="modal fade" id="btn_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">USER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <input class="form-control mb-2" type="text" id="name" name="name" placeholder="name">
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                                <input class="form-control mb-2" type="email" id="email" name="email"
                                    placeholder="email">
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                                <input class="form-control mb-2" type="password" id="password" name="password"
                                    placeholder="password">
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password"></div>
                                <input class="form-control mb-2" type="file" id="image" name="image"
                                    placeholder="image">
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>image</th>
                        <th>Aksi</th>
                    </tr>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }} .</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->password }}</td>
                        <td><img src="{{ $item->image }}" width="100px" alt="image"></td>
                        <td>
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $item->id }}"
                                class="btn btn-primary btn-sm"><i class=" fas fa-edit"></i></a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $item->id }}"
                                class="btn btn-danger btn-sm"><i class=" fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
