@extends('layouts.tables')
@section('title', 'Jurusan')
@section('table', 'Jurusan')
@section('contend')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                <a href="javascript:void(0)" class="btn btn-primary mb-2" id="btn-create-post">TAMBAH</a>

                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jurusan</th>
                            <th class=" text-center">Aksi</th>
                        </tr>
                    <tbody id="datalist" class="table">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript">
        // Fungsi untuk mengambil data menggunakan AJAX
        function getData() {
            $.ajax({
                url: '/jurusan',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var rows = '';

                    // Menghasilkan baris tabel dari data yang diterima
                    $.each(response, function(index, data) {
                        rows += '<tr>';
                        rows += '<td>' + (index + 1) + ' .</td>';
                        rows += '<td>' + data.jurusan + '</td>';
                        rows += '<td class="text-center">';
                        rows +=
                            '<a href="javascript:void(0)" id="btn-edit-post" data-id="' + data.id +
                            '"  class="btn btn-info btn-sm mr-2"><i class="fas fa-eye"></i></a>';
                        rows += '<a href="javascript:void(0)" id="btn-edit-post2" data-id="' + data.id +
                            '"  class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>';
                        rows += '<a href="javascript:void(0)" onclick="deleteData(' + data.id +
                            ')" class="btn btn-danger btn-sm mr-2"><i class=" fas fa-trash"></i></a>';
                        rows += '</td>';
                        rows += '</tr>';
                    });

                    $('#datalist').html(rows);

                    /* if ($.fn.DataTable.isDataTable('#datalist')) {
                         $('#datalist').DataTable().destroy();
                     }

                     // Inisialisasi DataTables pada tabel dengan id 'myTable'
                     $('#datalist').DataTable(); */
                }
            });
        }

        // Fungsi untuk menghapus data menggunakan AJAX
        function deleteData(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/jurusan/delete/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses',
                                text: response.message,
                                icon: 'success',
                                timer: 2000
                            });
                            getData(); // Mengambil data terbaru setelah menghapus
                        }
                    });
                }
            });
        }

        // Memanggil fungsi untuk mengambil data saat halaman dimuat
        $(document).ready(function() {
            getData();
        });

        // Button create post event
        $('body').on('click', '#btn-create-post', function() {
            // Open modal
            $('#modal-create').modal('show');
        });

        // Action create post
        $(document).on('click', '#store', function(e) {
            e.preventDefault();

            // Define variables
            let jurusan = $('#jurusan').val();
            let token = $('meta[name="csrf-token"]').attr('content');

            // AJAX
            $.ajax({
                url: '/jurusan/store',
                type: 'POST',
                cache: false,
                data: {
                    'jurusan': jurusan,
                    '_token': token
                },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Clear form
                    $('#jurusan').val('');

                    // Close modal
                    $('#modal-create').modal('hide');

                    getData(); // Mengambil data terbaru setelah memasukkan data baru
                },
                error: function(error) {
                    if (error.responseJSON.jurusan && error.responseJSON.jurusan[0]) {
                        // Show alert
                        $('#alert-jurusan').removeClass('d-none');
                        $('#alert-jurusan').addClass('d-block');

                        // Add message to alert
                        $('#alert-jurusan').html(error.responseJSON.jurusan[0]);
                    }
                }
            });
        });

        //edit and update
        //button create post event
        $('body').on('click', '#btn-edit-post', function() {
            let jurusan_id = $(this).data('id');

            // Fetch detail post with ajax
            $.ajax({
                url: `/jurusan/show/${jurusan_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    // Fill data to form
                    $('#jurusan_id').val(response.id);
                    $('#jurusan-edit').val(response.jurusan);

                    // Open modal
                    $('#modal-edit').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error case
                    console.log("Terjadi kesalahan dalam permintaan Ajax:", textStatus, errorThrown);
                }
            });
        });

        // Action update post
        $('#update').click(function(e) {
            e.preventDefault();

            // Define variables
            let jurusan_id = $('#jurusan_id').val();
            let jurusan = $('#jurusan-edit').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // Ajax
            $.ajax({
                url: `/jurusan/update/${jurusan_id}`,
                type: "PUT",
                cache: false,
                data: {
                    "jurusan": jurusan,
                    "_token": token,
                },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Close modal
                    $('#modal-edit').modal('hide');

                    // Fetch updated data and update the displayed data
                    $.ajax({
                        url: `/jurusan/show/${jurusan_id}`,
                        type: "GET",
                        cache: false,
                        success: function(response) {
                            // Update the displayed data
                            $('#jurusan-display').text(response.jurusan);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle error case
                            console.log("Terjadi kesalahan dalam permintaan Ajax:",
                                textStatus, errorThrown);
                        }
                    });
                },
                error: function(error) {
                    if (error.responseJSON.jurusan[0]) {
                        // Show alert
                        $('#alert-jurusan-edit').removeClass('d-none');
                        $('#alert-jurusan-edit').addClass('d-block');

                        // Add message to alert
                        $('#alert-jurusan-edit').html(error.responseJSON.jurusan[0]);
                    }
                }
            });
        });

        $(document).ready(function() {
            // Menyembunyikan modal saat halaman dimuat
            $('#modalShowPost').modal('hide');

            // Menangani klik tombol "btn-show-post"
            $(document).on('click', '.btn-show-post', function(e) {
                var jurusanid = $(this).data('id');

                // Mengirim permintaan Ajax untuk mendapatkan data detail posting berdasarkan ID
                $.ajax({
                    url: '/jurusan/show/' + jurusanid,
                    type: 'GET',
                    data: {
                        id: jurusanid
                    },
                    success: function(response) {
                        // Memperbarui konten modal dengan detail posting yang diterima dari server
                        $('#jurusan').val(response.jurusan);

                        // Menampilkan modal
                        $('#modalShowPost').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Menangani kesalahan jika permintaan Ajax gagal
                        console.log(error);
                    }
                });
            });
        });

        //edit kelas
        //button create post event

        $(document).ready(function() {
            // ...
            $('body').on('click', '#btn-edit-post2', function() {
                let jurusan_id = $(this).data('id');

                // Fetch detail post with ajax
                $.ajax({
                    url: `/jurusan/show/${jurusan_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        // Fill data to form
                        $('#jurusan_id2').val(response.id);
                        $('#jurusan-edit2').val(response.jurusan);

                        // Open modal
                        $('#modal-edit2').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error case
                        console.log("Terjadi kesalahan dalam permintaan Ajax:", textStatus,
                            errorThrown);
                    }
                });
            });

            // Action update post
            $('#update2').click(function(e) {
                e.preventDefault();

                // Define variables
                let jurusan_id = $('#jurusan_id2').val();
                let jurusan = $('#jurusan-edit2').val();
                let token = $("meta[name='csrf-token']").attr("content");

                // Ajax
                $.ajax({
                    url: `/jurusan/update/${jurusan_id}`,
                    type: "PUT",
                    cache: false,
                    data: {
                        "jurusan": jurusan,
                        "_token": token,
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // Close modal
                        $('#modal-edit2').modal('hide');

                        // Fetch updated data and update the displayed data
                       getData();
                    },
                    error: function(error) {
                        if (error.responseJSON.jurusan && error.responseJSON.jurusan[0]) {
                            // Show alert
                            $('#alert-jurusan-edit2').removeClass('d-none');
                            $('#alert-jurusan-edit2').addClass('d-block');

                            // Add message to alert
                            $('#alert-jurusan-edit2').html(error.responseJSON.jurusan[0]);
                        }
                    }
                });
            });
        });
    </script>
    @extends('jurusan.create')
    @extends('jurusan.edit')
    @extends('jurusan.show')
@endsection
