<table class="table table-bordered" id="pengajian" width="100%" cellspacing="0">
	<thead>
		<tr>
        	<th>NO.</th>
			<th>ID</th>
			<th>DEWAN KYAI</th>
			<th>FOTO</th>
			<th>KITAB</th>
			<th>HARI</th>
			<th>WAKTU</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
            $no = 1;
            foreach ($pengajian->result() as $pj) : ?>
			<tr>
				<td width="20px">
					<?php echo $no++ ?>
				</td>
				<td>
					<?php echo $pj->id_ngaji ?>
				</td>
				<td>
					<?php echo $pj->nama_kyai ?>
				</td>
				<td class="text-center">
				<img width="120" src="<?php echo base_url()?>assets/uploads/foto_kyai/<?php echo $pj->foto; ?>">
				</td>
				<td>
					<?php echo $pj->nama_kitab ?>
				</td>
				<td>
					<?php echo $pj->nama_hari ?>
				</td>
				<td>
					<?php echo $pj->waktu_p ?>
				</td>
				<td  style="display: flex;">
								
								<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
				<a>
					<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $pj->id_ngaji ?>"></i></button>
				</a>
				</div>&nbsp;&nbsp;
				<div class="btn btn-sm btn-danger">
					<i class="fa fa-trash hapus-data" data-id="<?php echo $pj->id_ngaji ?>"></i>
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
						<form id="form-excel-pengajian">
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
				<h5 class="modal-title" id="exampleModalLabel">EDIT JADWAL PENGAJIAN HARIAN</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
						</div>
					<div class="modal-body">
					    <form id="form-edit-pengajian" method='POST' enctype='multipart/form-data'>
					    	<input type="hidden" name="id"/>
							<div class="form-group">
								   <label>ID</label>
									<input type="text" class="form-control"  id="id_ngaji" name="id_ngaji" style="background:#d5d8eb;color: #000000;"disabled="disabled">
							</div>

							<div class="form-group">
								<label >DEWAN KYAI</label>
                                <select name="id_kyai" id="id_kyai" class="form-control">
									<option value="">Pilih Dewan Kyai</option>
									<?php foreach($kyai as $y): ?>
									<option value="<?php echo $y->id_kyai?>"><?php echo $y->nama_kyai?></option>	
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
							    <label >NAMA KITAB </label>
                                <select name="id_kitab" id="id_kitab" class="form-control">
									<option value="">Pilih Kitab</option>
									<?php foreach($kitab as $t): ?>
									<option value="<?php echo $t->id_kitab?>"><?php echo $t->nama_kitab?></option>	
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group">
							    <label>HARI</label>
                                <select name="id_hari" id="id_hari" class="form-control">
									<option value="">Pilih Hari</option>
									<?php foreach($hari as $h): ?>
									<option value="<?php echo $h->id_hari?>"><?php echo $h->nama_hari?></option>	
									<?php endforeach ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_s" name="nama_santri" style="background:#d5d8eb;color: #000000;"> -->
							</div>

							<div class="form-group">
							<label >WAKTU</label>
								<select name="id_w" id="id_w" class="form-control">
									<option value="">Pilih Waktu</option>
									<?php foreach($waktu as $w): ?>
									<option value="<?php echo $w->id_w?>"><?php echo $w->waktu_p?></option>	
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
             url: '<?=site_url('admin/pengajian/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#pengajian').DataTable().clear().destroy();
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
        url: '<?=site_url('admin/pengajian/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-pengajian input[name='id']").val(data.object.id_ngaji);
        $("#form-edit-pengajian input[name='id_ngaji']").val(data.object.id_ngaji);
		$("#id_kyai").val(data.object.id_kyai);
		var foto = data.object.foto;
        $('#foto-kyai').attr("src", `<?php echo base_url()?>assets/uploads/foto_kyai/${foto}`);
		$("#id_kitab").val(data.object.id_kitab);
        $("#id_hari").val(data.object.id_hari);
		$("#id_w").val(data.object.id_w);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-pengajian input[name='id_ngaji']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-pengajian").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/pengajian/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Pengajian berhasil diedit.", "success");
        $('#pengajian').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	$("#form-excel-pengajian").submit(function(e) {
      e.preventDefault();
      modal_upload = $("#modal-upload");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/pengajian/importExcel')?>',
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
        $('#pengajian').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>