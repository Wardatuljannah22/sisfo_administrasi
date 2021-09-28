<table class="table table-bordered" id="jumlah_santri" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>NO</th>
							<th>ID JUMLAH</th>
							<th>JUMLAH PUTRA</th>
              <th>JUMLAH PUTRI</th>
              <th>JUMLAH TOTAL</th>
              <th>TAHUN</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
				    	<?php $no = 1; ?>
					     <?php foreach($jumlah_santri->result() as $js) : ?>
						<tr>
							<td width="20px">
								<?php echo $no++ ?>
							</td> 
							<td>
								<?php echo $js->id_jumlah ?>
							</td>
							<td>
								<?php echo $js->jumlah_putra ?>
							</td>
              <td>
								<?php echo $js->jumlah_putri ?>
							</td>
              <td>
								<?php echo $js->jumlah_total ?>
							</td>
              <td>
								<?php echo $js->tahun ?>
							</td>
							
              <td style="display: flex;">
								<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
								<a>
									<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $js->id_jumlah ?>"></i></button>
								</a>
								</div>&nbsp;&nbsp;
								<div class="btn btn-sm btn-danger">
								<i class="fa fa-trash hapus-data" data-id="<?php echo $js->id_jumlah ?>"></i>
								</div>&nbsp;&nbsp;
							</td>

						</tr>
						<?php endforeach;?>
					</tbody>
				</table>

			<!-- Modal untuk edit -->

			<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Data Jumlah Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-edit-jumlah-santri" method='POST' enctype='multipart/form-data'>
						<input type="hidden" name="id"/>
							<!-- <div class="form-group">
							<label >ID JUMLAH </label>	
									<input type="text" class="form-control" id="id_jumlah" name="id_jumlah" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div> -->
						
							<div class="form-group">
							<label >JUMLAH PUTRA</label>
									<input type="text" class="form-control" id="jumlah_putra" name="jumlah_putra" style="background:#d5d8eb;color: #000000;">
							</div>

              <div class="form-group">
							<label >JUMLAH PUTRI</label>
									<input type="text" class="form-control" id="jumlah_putri" name="jumlah_putri" style="background:#d5d8eb;color: #000000;">
							</div>

              <div class="form-group">
							<label >JUMLAH TOTAL</label>
									<input type="text" class="form-control" id="jumlah_total" name="jumlah_total" style="background:#d5d8eb;color: #000000;">
							</div>

              <div class="form-group">
							<label >TAHUN</label>
									<input type="text" class="form-control" id="tahun" name="tahun" style="background:#d5d8eb;color: #000000;">
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
             url: '<?=site_url('admin/jumlah_santri/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#jumlah_santri').DataTable().clear().destroy();
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
        url: '<?=site_url('admin/jumlah_santri/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
	     	$("#form-edit-jumlah-santri input[name='id']").val(data.object.id_jumlah);
        $("#form-edit-jumlah-santri input[name='id_jumlah']").val(data.object.id_jumlah);
        $("#form-edit-jumlah-santri input[name='jumlah_putra']").val(data.object.jumlah_putra);
        $("#form-edit-jumlah-santri input[name='jumlah_total']").val(data.object.jumlah_total);
        $("#form-edit-jumlah-santri input[name='tahun']").val(data.object.tahun);

        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-jumlah-santri input[name='id_jumlah']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-jumlah-santri").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/jumlah_santri/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Jumlah Santri berhasil diedit.", "success");
        $('#jumlah_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>