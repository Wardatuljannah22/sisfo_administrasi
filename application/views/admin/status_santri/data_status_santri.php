<table class="table table-bordered" id="status_santri" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>NO</th>
							<th>ID STATUS</th>
							<th>STATUS</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
				    	<?php $no = 1; ?>
					     <?php foreach($status_santri->result() as $ss) : ?>
						<tr>
							<td width="20px">
								<?php echo $no++ ?>
							</td> 
							<td>
								<?php echo $ss->id_status ?>
							</td>
							<td>
								<?php echo $ss->nama_status ?>
							</td>
						
							<td  style="display: flex;">
								<!-- <div class="btn btn-sm btn-success">
								<i class="fa fa-search-plus"></i>
								</div>&nbsp;&nbsp; -->
								<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
								<a>
									<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $ss->id_status ?>"></i></button>
								</a>
								</div>&nbsp;&nbsp;
								<div class="btn btn-sm btn-danger">
									<i class="fa fa-trash hapus-data" data-id="<?php echo $ss->id_status ?>"></i>
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
							<h5 class="modal-title" id="exampleModalLabel">Edit Status Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-edit-status-santri" method='POST' enctype='multipart/form-data'>
						<input type="hidden" name="id"/>
							<!-- <div class="form-group">
							<label >ID STATUS </label>	
									<input type="text" class="form-control" id="id_st" name="id_status" style="background:#d5d8eb;color: #000000;">
							</div> -->
						
							<div class="form-group">
							<label >STATUS SANTRI</label>
									<input type="text" class="form-control" id="status_s" name="nama_status" style="background:#d5d8eb;color: #000000;">
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
             url: '<?=site_url('admin/status_santri/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#status_santri').DataTable().clear().destroy();
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
        url: '<?=site_url('admin/status_santri/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
		    $("#form-edit-status-santri input[name='id']").val(data.object.id_status);
        $("#form-edit-status-santri input[name='id_status']").val(data.object.id_status);
        $("#form-edit-status-santri input[name='nama_status']").val(data.object.nama_status);
    
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-status-santri input[name='id_status']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-status-santri").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/status-santri/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Status Santri berhasil diedit.", "success");
        $('#status_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>