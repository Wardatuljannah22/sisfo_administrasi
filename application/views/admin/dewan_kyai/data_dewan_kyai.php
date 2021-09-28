<table class="table table-bordered" id="dewan_kyai" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>NO</th>
      <th>ID KYAI</th>
      <th>NAMA KYAI</th>
      <th>FOTO</th>
      <th>AKSI</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($dewan_kyai->result() as $de) : ?>
      <tr>
        <td width="20px">
          <?php echo $no++ ?>
        </td>
        <td>
          <?php echo $de->id_kyai ?>
        </td>
        <td>
          <?php echo $de->nama_kyai ?>
        </td>
        <td class="text-center">
          <img width="120" src="<?php echo base_url() ?>assets/uploads/foto_kyai/<?php echo $de->foto; ?>">
        </td>

        <td style="display: flex;">

          <!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
          <a>
            <button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $de->id_kyai ?>"></i></button>
          </a>
          </div>&nbsp;&nbsp;
          <div class="btn btn-sm btn-danger">
            <i class="fa fa-trash hapus-data" data-id="<?php echo $de->id_kyai ?>"></i>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Dewan Kyai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-edit-dewan-kyai" method='POST' enctype='multipart/form-data'>
          <input type="hidden" name="id" />
          <!-- <div class="form-group">
							<label >ID KYAI </label>	
									<input type="text" class="form-control" id="id_ky" name="id_kyai" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div> -->

          <div class="form-group">
            <label>NAMA KYAI</label>
            <input type="text" class="form-control" id="nama_k" name="nama_kyai" style="background:#d5d8eb;color: #000000;">
          </div>
          <div class="form-group">
            <label for="pic_file">Foto*:</label><br>
            <img id="foto-kyai" src="" alt="Foto Santri" width="150" height="200">
            <input type="file" name="foto" class="form-control" id="pic_file">
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
            url: '<?= site_url('admin/dewan_kyai/crud/delete') ?>',
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
              $('#dewan_kyai').DataTable().clear().destroy();
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
        url: '<?= site_url('admin/dewan_kyai/get_by_id') ?>',
        type: 'GET',
        dataType: 'json',
        data: {
          id: id
        },
      })
      .done(function(data) {
        $("#form-edit-dewan-kyai input[name='id']").val(data.object.id_kyai);
        $("#form-edit-dewan-kyai input[name='id_kyai']").val(data.object.id_kyai);
        $("#form-edit-dewan-kyai input[name='nama_kyai']").val(data.object.nama_kyai);
        var foto = data.object.foto;
        $('#foto-kyai').attr("src", `<?php echo base_url() ?>assets/uploads/foto_kyai/${foto}`);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-dewan-kyai input[name='id_kyai']").focus();
        });
      });
  });
  //Proses Update ke Db
  $("#form-edit-dewan-kyai").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?= site_url('admin/dewan_kyai/crud/update') ?>',
      type: 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function(data) {
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Dewan Kyai berhasil diedit.", "success");
        $('#dewan_kyai').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response) {
        alert(response);
      }
    })
  });
</script>