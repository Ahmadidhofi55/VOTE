<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH KELAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kelas"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-success" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  // Button create post event
  $('body').on('click', '#btn-create-post', function () {
    // Open modal
    $('#modal-create').modal('show');
  });

  // Action create post
  $('#store').click(function(e) {
    e.preventDefault();
    // Define variables
    let kelas = $('#kelas').val();
    let token = $("meta[name='csrf-token']"); // Get the value of the CSRF token

    // AJAX
    $.ajax({
      url: '/kelas',
      type: 'POST',
      cache: false,
      data: {
        "kelas": kelas,
        "_token": token
      },
      success: function(response) {
        // Show success message
        Swal.fire({
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 3000
        });

        // Data post
        let kelasRow = `
          <tr id="index_${response.data.id}">
            <td>${response.data.kelas}</td>
            <td class="text-center">
              <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
              <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        `;

        // Append to table
        $('#dataTable').prepend(kelasRow);

        // Clear form
        $('#kelas').val('');

        // Close modal
        $('#modal-create').modal('hide');
      },
      error: function(error) {
        if (error.responseJSON && error.responseJSON.kelas && error.responseJSON.kelas[0]) {
          // Show alert
          $('#alert-kelas').removeClass('d-none');
          $('#alert-kelas').addClass('d-block');
          // Add message to alert
          $('#alert-kelas').html(error.responseJSON.kelas[0]);
        }
      }
    });
  });
</script>
