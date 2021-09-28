<table class="table table-bordered" id="majelis_santri" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>NO</th>
							<th>NIS</th>
							<th>NAMA</th>
							<th>JENIS KELAMIN</th>
							<th>JABATAN</th>
							<th>ASAL UNIVERSITAS</th>
                            <th>NAMA ANGKATAN</th>
							<th>FOTO</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1; ?>
						<?php foreach($majelis_santri->result() as $ms) : ?>
						<tr>
							<td width="20px">
								<?php echo $no++ ?>
							</td>
							<td>
								<?php echo $ms->nis ?>
							</td>
							<td>
								<?php echo $ms->nama_santri ?>
							</td>
							<td>
								<?php echo $ms->jenis_kelamin ?>
							</td>
							<td>
								<?php echo $ms->nama_jabatan ?>
							</td>
							<td>
								<?php echo $ms->nama_univ ?>
							</td>
                            <td>
								<?php echo $ms->nama_angk ?>
							</td>
							<td class="text-center">
								<img width="120" src="<?php echo base_url()?>assets/uploads/foto_santri/<?php echo $ms->foto2; ?>">
							</td>
							<td  style="display: flex;">
								
								<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
								<a>
									<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $ms->id2 ?>"></i></button>
								</a>
								</div>&nbsp;&nbsp;
								<div class="btn btn-sm btn-danger">
									<i class="fa fa-trash hapus-data" data-id="<?php echo $ms->id2 ?>"></i>
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
						<form id="form-excel-majelis">
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
							<h5 class="modal-title" id="exampleModalLabel">Edit Majelis Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form id="form-edit-majelis-santri" method='POST' enctype='multipart/form-data'>
						<input type="hidden" name='id'/>
						<div class="form-group">
							<label >NIS</label>
							<select class="form-control select2" onchange="myNisEdit()" name="nis_ms" id="nisedit" style="width: 100%;">
									<?php foreach($biodata_santri as $jb): ?>
									<option value="<?php echo $jb->nis?>"><?php echo $jb->nis.'-'.$jb->nama_santri?></option>	
									<?php endforeach ?>
							</select>
							</div>
							<div class="form-group">
							<label>Jenis Kelamin</label>
									<input type="text" class="form-control" id="jk_edit" name="jk_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div>
							<div class="form-group">
							<label>Nama Angkatan</label>
									<input type="text" class="form-control" id="angkatan_edit" name="angkatan_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div>
							<div class="form-group">
							<label>Asal Universitas</label>
									<input type="text" class="form-control" id="universitas_edit" name="universitas_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
							</div>
							<div class="form-group">
							<label >Jabatan</label>
							<select name="id_jabatan" id="jabatanedit" class="form-control select2" style="width: 100%;">
									<?php foreach($jabatan_ms as $jb): ?>
									<option value="<?php echo $jb->id_jabatan?>"><?php echo $jb->nama_jabatan?></option>	
									<?php endforeach ?>
								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
									
							</>
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
             url: '<?=site_url('admin/majelis_santri/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#majelis_santri').DataTable().clear().destroy();
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
        url: '<?=site_url('admin/majelis_santri/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
		$("#form-edit-majelis-santri input[name='id']").val(data.object.id);
        $("#form-edit-majelis-santri input[name='nis_ms']").val(data.object.nis_ms);
		$("#form-edit-majelis-santri input[name='jk_tbh']").val(data.object.jenis_kelamin);
		$("#form-edit-majelis-santri input[name='angkatan_tbh']").val(data.object.nama_angk);
		$("#form-edit-majelis-santri input[name='universitas_tbh']").val(data.object.nama_univ);
		$("#jabatanedit").val(data.object.id_jabatan);
		$("#nisedit").val(data.object.nis);
		$('#nisedit').select2({
		theme: 'bootstrap4',
		});
		$('#jabatanedit').select2({
		theme: 'bootstrap4',
		});
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-majelis-santri input[name='nis_ms']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-majelis-santri").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('admin/majelis_santri/crud/update')?>',
      type: 'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data Maajelis Santri berhasil diedit.", "success");
        $('#majelis_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	$("#form-excel-majelis").submit(function(e) {
      e.preventDefault();
      modal_upload = $("#modal-upload");
      form = $(this);
      $.ajax({
       url: '<?=site_url('admin/majelis_santri/importExcel')?>',
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
        $('#majelis_santri').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
	function myNisEdit()
    { 
      let nis = $("#nisedit").val();
      $.ajax({
        url: '<?=site_url('admin/majelis_santri/get_biodata')?>',
        type: 'GET',
        dataType: 'json',
        data: {nis: nis},
        success: function(data) {
          $("#jk_edit").val(data.object.jenis_kelamin);
          $("#angkatan_edit").val(data.object.nama_angk);
          $("#universitas_edit").val(data.object.nama_univ);
        },
        error: function (request, status, error) {
          alert('Tidak tersedia');
        }
      })
    }
</script>