<table class="table table-bordered" id="biodata_santri" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>NO.</th>
			<th>NIS</th>
			<th>NAMA</th>
			<th>TEMPAT LAHIR</th>
			<th>TANGGAL LAHIR</th>
			<th>JENIS KELAMIN</th>
			<th>ALAMAT</th>
			<th>JURUSAN</th>
			<th>ASAL UNIV</th>
			<th>ANGKATAN </th>
			<th>STATUS</th>
			<th>FOTO</th>
			<th>AKSI</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
            $no = 1;
        	foreach ($biodata_santri->result() as $bds) : ?>
		<tr>
			<td width="20px">
				<?php echo $no++ ?>
			</td> 
			<td>
				<?php echo $bds->nis ?>
			</td>
			<td>
				<?php echo $bds->nama_santri ?>
			</td>
			<td>
				<?php echo $bds->tempat_lahir ?>
			</td>
			<td>
				<?php echo $bds->tgl_lahir ?>
			</td>
			<td>
				<?php echo $bds->jenis_kelamin ?>
			</td>
			<td>
				<?php echo $bds->alamat ?>
			</td>
			<td>
				<?php echo $bds->jurusan ?>
			</td>
			<td>
				<?php echo $bds->nama_univ ?>
			</td>
			<td>
				<?php echo $bds->nama_angk ?>
			</td>
			<td>
				<?php echo $bds->nama_status ?>
			</td>
			
			<td class="text-center">
			<img width="120" src="<?php echo base_url()?>assets/uploads/foto_santri/<?php echo $bds->foto; ?>">
			</td>
			    				
			<td  style="display: flex;">
								
								<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
				<a>
					<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $bds->nis ?>"></i></button>
				</a>
				</div>&nbsp;&nbsp;
				<div class="btn btn-sm btn-danger">
					<i class="fa fa-trash hapus-data" data-id="<?php echo $bds->nis ?>"></i>
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
							<h5 class="modal-title" id="exampleModalLabel">Edit Data Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-edit-biodata-santri" method='POST' enctype='multipart/form-data'>
						    <input type="hidden" name="id"/>
							<div class="form-group">
								   <label>NIS</label>
									<input type="text" class="form-control"  id="nis" name="nis" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div>
							<div class="form-group">
							<label>Nama Santri</label>
									<input type="text" class="form-control" id="nama_s" name="nama_santri" style="background:#d5d8eb;color: #000000;">
							</div>

							<div class="form-group">
							<label>Tempat Lahir</label>
									<input type="text" class="form-control" id="tempat_t" name="tempat_lahir" style="background:#d5d8eb;color: #000000;">
							</div>

							<div class="form-group">
							<label > Tanggal Lahir</label>	
									<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" style="background:#d5d8eb;color: #000000;">
							</div>
							<div class="form-group">
							<label>Jenis Kelamin</label>
								<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
									<option value="">--Pilih Jenis Kelamin--</option>
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
							<label >Alamat</label>
									<input type="text" class="form-control" id="alamat" name="alamat" style="background:#d5d8eb;color: #000000;">
							</div>
							<div class="form-group">
							<label >Jurusan</label>	
									<input type="text" class="form-control" id="jurusan" name="jurusan" style="background:#d5d8eb;color: #000000;">	
							</div>
							<div class="form-group">
							<label >Asal Universitas</label>
								<select name="id_univ" id="id_univ" class="form-control">
									<option value="">Pilih Universitas</option>
									<?php foreach($univ as $u): ?>
									<option value="<?php echo $u->id_univ?>"><?php echo $u->nama_univ?></option>	
									<?php endforeach ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
							</div>
							
							<div class="form-group">
							<label >Nama Angkatan</label>
								<select name="id_angk" id="id_angk" class="form-control">
									<option value="">Pilih Angkatan</option>
									<?php foreach($nama_angkatan as $a): ?>
									<option value="<?php echo $a->id_angk?>"><?php echo $a->nama_angk?></option>	
									<?php endforeach ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
							</div>
							<div class="form-group">
							<label >Status</label>
								<select name="id_status" id="id_status" class="form-control">
									<option value="">Pilih Status</option>
									<?php foreach($status as $a){?>
									<option value="<?php echo $a->id_status?>"><?php echo $a->nama_status?></option>	
									<?php } ?>
								</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
							</div>
							<div class="form-group">
								<label for="pic_file">Foto*:</label><br>
								<img id="foto-santri" src="" alt="Foto Santri" width="150" height="200">
								<input type="file" name="foto" class="form-control"  id="pic_file">
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


			<div class="modal fade" id="modal-multiple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Form Upload Multiple</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-multiple">
							<div class="form-group">
                                 <label for="multiple">Upload Multiple</label>
                                <input type="file" autocomplete="off"class="form-control" name='files[]' multiple="" placeholder="Pilih Foto">
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
						<form id="form-excel-santri">
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

<script>
	//menampilkan data dihapus
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
             url: '<?=site_url('admin/biodata_santri/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#biodata_santri').DataTable().clear().destroy();
                  refresh_table();
             }
          });
        } else {
          swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
        }
      });
    });

	// menampilkan data di edit
	modal_edit = $("#modal-edit");
    $(".edit-data").click(function(e) {
      id = $(this).data('id');
      $.ajax({
        url: '<?=site_url('admin/biodata_santri/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
	  .done(function(data) {
		$("#form-edit-biodata-santri input[name='id']").val(data.object.nis);
        $("#form-edit-biodata-santri input[name='nis']").val(data.object.nis);
        $("#form-edit-biodata-santri input[name='nama_santri']").val(data.object.nama_santri);
		$("#form-edit-biodata-santri input[name='tempat_lahir']").val(data.object.tempat_lahir);
        $("#form-edit-biodata-santri input[name='tgl_lahir']").val(data.object.tgl_lahir);
        $("#form-edit-biodata-santri input[name='alamat']").val(data.object.alamat);
        $("#form-edit-biodata-santri input[name='jurusan']").val(data.object.jurusan);
		var foto = data.object.foto;
        $('#foto-santri').attr("src", `<?php echo base_url()?>assets/uploads/foto_santri/${foto}`);
        $("#id_status").val(data.object.id_status);
		$("#id_angk").val(data.object.id_angk);
		$("#id_univ").val(data.object.id_univ);
        $("#jenis_kelamin").val(data.object.jenis_kelamin);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-biodata-santri input[name='nis']").focus();
        });
      });
    })
    //Proses Update ke Db
    $("#form-edit-biodata-santri").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/biodata_santri/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Biodata Santri berhasil diedit.", "success");
        $('#biodata_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	// $("#form-multiple").submit(function(e) {
    //   e.preventDefault();
    //   modal_multiple = $("#modal-multiple");
    //   form = $(this);
    //   $.ajax({
    //    url: '<?=site_url('admin/data_kamar/multipleUpload')?>',
    //    type: 'POST',
    //    data:new FormData(this),
    //    processData:false,
    //    contentType:false,
    //    cache:false,
    //    async:false,
    //   success: function(){ 
    //     swal("Berhasil!", "Upload Multiple Foto Santri Berhasil.", "success");
    //     form[0].reset();
    //     modal_multiple.modal('hide');
    //     $('#biodata_santri').DataTable().clear().destroy();
    //     refresh_table();
    //   },
    //   error: function(response){
    //       alert(response);
    //   }
    //  })
    // });
	$("#form-excel-santri").submit(function(e) {
      e.preventDefault();
      modal_upload = $("#modal-upload");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/biodata_santri/importExcel')?>',
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
        $('#biodata_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	$("#form-multiple").submit(function(e) {
		e.preventDefault();
		modal_multiple = $("modal-multiple");
		form = $(this);
		$.ajax({
			url: '<?=site_url('admin/biodata_santri/multipleUpload')?>',
			type: 'POST',
			data:new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(){
				swal("Berhasil!", "Upload Multiple Foto Santri Berhasil.", "success");
				form[0].reset();
				modal_multiple.modal('hide');
				$('#biodata_santri').DataTable().clear().destroy();
				refresh_table();
			},
			error: function(response){
				alert(response);
			}
		})
	});
</script>