@extends('layouts.tables')
@section('title','USER')
@section('table','USER')
@section('contend')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Button trigger modal -->
            <a href="javascript:void(0)" class="btn btn-primary mb-2" id="btn-create-post">TAMBAH</a>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                <tbody>
                    @foreach ($kelas as $item)
                    <tr id="index_{{ $item->id }}">
                        <td>{{ $item->id }} .</td>
                        <td>{{ $item->kelas }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $item->id }}" class="btn btn-danger btn-sm"><i class=" fas fa-trash"></i></a>
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

@include('kelas.modal_create')

@endsection
