<table class="table table-bordered" id="madin" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>No</th>
			<th>KELAS</th>
			<th>DEWAN ASATIDZ</th>
			<th>MAPEL</th>
            <th>HARI</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
            $no = 1;
            foreach ($madin->result() as $md) : ?>
				<tr>
					<td width="20px">
						<?php echo $no++ ?>
					</td>
				    <td>
					    <?php echo $md->nama_kelas ?>
					</td>
					<td>
						<?php echo $md->nama_ust ?>
					</td>
					<td>
						<?php echo $md->nama_mapel ?>
					</td>
                    <td>
					    <?php echo $md->nama_hari ?>
					</td>
					<td  style="display: flex;">
										<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
						<a>
							<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $md->id_ma ?>"></i></button>
						</a>
						</div>&nbsp;&nbsp;
						<div class="btn btn-sm btn-danger">
							<i class="fa fa-trash hapus-data" data-id="<?php echo $md->id_ma ?>"></i>
					</div>&nbsp;&nbsp;
							
			</td>		
			    </tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Modal untuk edit -->
<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Form Import Data Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-excel-madin">
						    <input type="hidden" name="id"/>
							<div class="form-group">
                              <label for="excel">Import Excel</label>
                              <input type="file" autocomplete="off"class="form-control" name="excel" placeholder="Pilih Foto">
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


<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EDIT JADWAL MADIN</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
						</div>
					<div class="modal-body">
					    <form id="form-edit-madin" method='POST' enctype='multipart/form-data'>
							<div class="form-group">
								   <label>ID</label>
									<input type="text" class="form-control"  id="id_ma" name="id_ma" style="background:#d5d8eb;color: #000000;"disabled="disabled">
							</div>
							<div class="form-group">
							    <label>KELAS</label>
                                <select name="id_kelas" id="id_kelas" class="form-control">
									<option value="">Pilih Kelas</option>
									<?php foreach($kelas as $l): ?>
									<option value="<?php echo $l->id_kelas?>"><?php echo $l->nama_kelas?></option>	
									<?php endforeach ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_s" name="nama_santri" style="background:#d5d8eb;color: #000000;"> -->
							</div>

							<div class="form-group">
							    <label >NAMA ASATIDZ </label>
                                <input type="text" class="form-control" id="nama_ust" name="nama_ust" style="background:#d5d8eb;color: #000000;">
							</div>

							<div class="form-group">
							<label >NAMA MAPEL</label>
                                <select name="id_mapel" id="id_mapel" class="form-control">
									<option value="">Pilih MAPEL</option>
									<?php foreach($mapel as $m): ?>
									<option value="<?php echo $m->id_mapel?>"><?php echo $m->nama_mapel?></option>	
									<?php endforeach ?>
								</select>
							</div>
						
							<div class="form-group">
							<label >HARI</label>
								<select name="id_hari" id="id_hari" class="form-control">
									<option value="">Pilih Hari</option>
									<?php foreach($hari as $h): ?>
									<option value="<?php echo $h->id_hari?>"><?php echo $h->nama_hari?></option>	
									<?php endforeach ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
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
             url: '<?=site_url('admin/madin/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#madin').DataTable().clear().destroy();
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
        url: '<?=site_url('admin/madin/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
		$("#form-edit-madin input[name='id']").val(data.object.id_ma);
        $("#form-edit-madin input[name='id_ma']").val(data.object.id_ma);
		$("#form-edit-madin input[name='nama_ust']").val(data.object.nama_ust);
		$("#id_kelas").val(data.object.id_kelas);
		$("#id_mapel").val(data.object.id_mapel);
		$("#id_hari").val(data.object.id_hari);
        $("#jenis_kelamin").val(data.object.jenis_kelamin);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-madin input[name='id_ma']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-madin").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/madin/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Jadwal Madin berhasil diedit.", "success");
        $('#madin').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	$("#form-excel-madin").submit(function(e) {
      e.preventDefault();
      modal_upload = $("#modal-upload");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/madin/importExcel')?>',
       type: 'POST',
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        swal("Berhasil!", "Data Biodata Santri Dari Excel Berhasil Di Import.", "success");
        form[0].reset();
        modal_upload.modal('hide');
        $('#madin').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>