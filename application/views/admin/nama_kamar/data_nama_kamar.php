<table class="table table-bordered" id="nama_kamar" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>NO</th>
      <th>ID KAMAR</th>
      <th>NAMA KAMAR</th>
      <th>JENIS KELAMIN</th>
      <th>KUOTA TERSEDIA</th>
      <th>AKSI</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($nama_kamar->result() as $nk) : ?>
      <tr>
        <td width="20px">
          <?php echo $no++ ?>
        </td>
        <td>
          <?php echo $nk->id_ka ?>
        </td>
        <td>
          <?php echo $nk->nama_ka ?>
        </td>
        <td>
          <?php echo $nk->jenis_kelamin ?>
        </td>
        <td>
          <?php echo $nk->kuota_kamar ?>
        </td>

        <td style="display: flex;">
          <!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
          <a>
            <button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $nk->id_ka ?>"></i></button>
          </a>
          </div>&nbsp;&nbsp;
          <div class="btn btn-sm btn-danger">
            <i class="fa fa-trash hapus-data" data-id="<?php echo $nk->id_ka ?>"></i>
          </div>&nbsp;&nbsp;

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal untuk edit -->

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Nama Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-edit-nama-kamar" method='POST' enctype='multipart/form-data'>
          <input type="hidden" name="id" />

          <div class="form-group">
            <label>NAMA KAMAR</label>
            <input type="text" class="form-control" id="nama_k" name="nama_ka" style="background:#d5d8eb;color: #000000;">
          </div>

          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jk_edit" class="form-control">
              <option value="">--Pilih Jenis Kelamin--</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Kuota Kamar</label>
            <input type="text" class="form-control" id="kuota_k" name="kuota_ka" style="background:#d5d8eb;color: #000000;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(".hapus-data").click(function(e) {
    e.preventDefault();
    id = $(this).data('id');
    swal({
        title: "Apa Anda Yakin?",
        text: "Data yang terhapus,tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batalkan!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: '<?= site_url('admin/nama_kamar/crud/delete') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
              id: id
            },
            error: function() {
              alert('Something is wrong');
            },
            success: function(data) {
              swal("Berhasil!", "Data Berhasil Dihapus.", "success");
              $('#nama_kamar').DataTable().clear().destroy();
              refresh_table();
            }
          });
        } else {
          swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
        }
      });
  });
  modal_edit = $("#modal-edit");
  $(".edit-data").click(function(e) {
    id = $(this).data('id');
    $.ajax({
        url: '<?= site_url('admin/nama_kamar/get_by_id') ?>',
        type: 'GET',
        dataType: 'json',
        data: {
          id: id
        },
      })
      .done(function(data) {
        $("#form-edit-nama-kamar input[name='id']").val(data.object.id_ka);
        $("#form-edit-nama-kamar input[name='nama_ka']").val(data.object.nama_ka);
        $("#form-edit-nama-kamar input[name='kuota_ka']").val(data.object.kuota_kamar);
        $("#jk_edit").val(data.object.jenis_kelamin);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-nama-kamar input[name='id_ka']").focus();
        });
      });
  });
  //Proses Update ke Db
  $("#form-edit-nama-kamar").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?= site_url('admin/nama_kamar/crud/update') ?>',
      type: 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function(data) {
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Nama Kamar berhasil diedit.", "success");
        $('#nama_kamar').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response) {
        alert(response);
      }
    })
  });
</script>