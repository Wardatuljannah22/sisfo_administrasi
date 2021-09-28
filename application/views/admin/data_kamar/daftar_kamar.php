<table class="table table-bordered" id="data_kamar" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA KAMAR</th>
			<th>NAMA PENGHUNI</th>
			<th>JENIS KELAMIN</th>
			<th>KUOTA TERSEDIA</th>
			<th>ANGKATAN </th>
			<th>STATUS </th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		<?php foreach ($data_kamar->result() as $kam) : ?>
			<tr>
				<td width="20px">
					<?php echo $no++ ?>
				</td>
				<td>
					<?php echo $kam->nama_ka ?>
				</td>
				<td>
					<?php echo $kam->nama_penghuni ?>
				</td>
				<td>
					<?php echo $kam->jenis_kelamin ?>
				</td>
				<td>
					<?php echo $kam->kuota_kamar ?>
				</td>
				<td>
					<?php echo $kam->nama_angk ?>
				</td>
				<td>
					<?php echo $kam->nama_status ?>
				</td>

				<td style="display: flex;">

					<!-- Gak bisa karena data target modal belum dipanggil dan data id nya belum dibuat -->
					<a>
						<button class='btn btn-sm btn-primary'><i class="fa fa-edit edit-data" data-id="<?php echo $kam->id_kamar ?>"></i></button>
					</a>
					</div>&nbsp;&nbsp;
					<div class="btn btn-sm btn-danger">
						<i class="fa fa-trash hapus-data" data-id="<?php echo $kam->id_kamar ?>"></i>
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
				<h5 class="modal-title" id="exampleModalLabel">Edit Data Kamar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-edit-data-kamar" method='POST' enctype='multipart/form-data'>
					<input type="hidden" name="id" />
					<input type="hidden" id="kuota_tbh4" />
					<input type="hidden" id="kuota_kas" />
					<div class="form-group">
						<label>Nama Kamar</label>
						<select name="id_ka" onchange="myKuotaEdit()" id="id_ka_edit" class="form-control">
							<option value="">Pilih Kamar</option>
							<?php foreach ($nama_kamar as $a) { ?>
								<option value="<?php echo $a->id_ka ?>"><?php echo $a->nama_ka ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Kuota orang</label>
						<input type="text" class="form-control" id="sisa_k_edit" name="sisa_k" style="background:#d5d8eb;color: #000000;" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Nama Penghuni </label>
						<input type="text" class="form-control" id="nama_p" name="nama_penghuni" style="background:#d5d8eb;color: #000000;">
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
						<label>Kuota terisi</label>
						<input type="number" min="1" class="form-control" id="kuota_ka_edit" name="kuota_kamar" style="background:#d5d8eb;color: #000000;">
					</div>
					<div class="form-group">
						<label>Nama Angkatan</label>
						<select name="id_angk" id="id_angk" class="form-control">
							<option value="">Pilih Angkatan</option>
							<?php foreach ($nama_angkatan as $a) : ?>
								<option value="<?php echo $a->id_angk ?>"><?php echo $a->nama_angk ?></option>
							<?php endforeach ?>
						</select>
						<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="id_status" id="id_status" class="form-control">
							<option value="">Pilih Status</option>
							<?php foreach ($status as $a) { ?>
								<option value="<?php echo $a->id_status ?>"><?php echo $a->nama_status ?></option>
							<?php } ?>
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


<!-- <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data Santri</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-excel-santri">
					<input type="hidden" name="id" />
					<div class="form-group">
						<label for="excel">Import Excel</label>
						<input type="file" autocomplete="off" class="form-control" name="excel" placeholder="Pilih Foto">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</div> -->

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
						url: '<?= site_url('admin/data_kamar/crud/delete') ?>',
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
							$('#data_kamar').DataTable().clear().destroy();
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
				url: '<?= site_url('admin/data_kamar/get_by_id') ?>',
				type: 'GET',
				dataType: 'json',
				data: {
					id: id
				},
			})
			.done(function(data) {
				$("#form-edit-data-kamar input[name='id']").val(data.object.id_kamar);
				$("#form-edit-data-kamar input[name='id_kamar']").val(data.object.id_kamar);
				$("#form-edit-data-kamar input[name='nama_penghuni']").val(data.object.nama_penghuni);
				$("#form-edit-data-kamar input[name='kuota_kamar']").val(data.object.kuota_kamar);
				$("#form-edit-data-kamar input[name='sisa_k']").val(data.object.kuota2 + " Kamar");
				$("#id_status").val(data.object.id_status);
				$("#id_angk").val(data.object.id_angk);
				$("#jenis_kelamin").val(data.object.jenis_kelamin);
				$("#kuota_tbh4").val(data.object.kuota2);
				$("#kuota_kas").val(data.object.kuota_kamar);
				$("#id_ka_edit").val(data.object.id_ka);
				modal_edit.modal('show').on('shown.bs.modal', function(e) {
					$("#form-edit-data-kamar input[name='id_kamar']").focus();
				});
			});
	});
	//Proses Update ke Db
	$("#form-edit-data-kamar").submit(function(e) {
		e.preventDefault();
		form = $(this);
		total = parseInt($('#kuota_ka_edit').val()) - parseInt($('#kuota_kas').val())
		if (parseInt($('#kuota_tbh4').val()) < total) {
			swal("Gagal!", "Kuota kamar melebihi kuota yang tersedia.", "warning");
		} else if (parseInt($('#kuota_tbh4').val()) >= total) {
			$.ajax({
				url: '<?= site_url('admin/data_kamar/crud/update') ?>',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					form[0].reset();
					modal_edit.modal('hide');
					swal("Berhasil!", "Data Data Kamar berhasil diedit.", "success");
					$('#data_kamar').DataTable().clear().destroy();
					refresh_table();
				},
				error: function(response) {
					alert(response);
				}
			})
		}
	});
	// $("#form-multiple").submit(function(e) {
	//   e.preventDefault();
	//   modal_multiple = $("#modal-multiple");
	//   form = $(this);
	//   $.ajax({
	//    url: '<?= site_url('admin/data_kamar/multipleUpload') ?>',
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
	$("#form-excel-data-kamar").submit(function(e) {
		e.preventDefault();
		modal_upload = $("#modal-upload");
		form = $(this);
		$.ajax({
			url: '<?= site_url('admin/data_kamar/importExcel') ?>',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function() {
				swal("Berhasil!", "Data Kamar Dari Excel Berhasil Di Import.", "success");
				form[0].reset();
				modal_upload.modal('hide');
				$('#data_kamar').DataTable().clear().destroy();
				refresh_table();
			},
			error: function(response) {
				alert(response);
			}
		})
	});

	function myKuotaEdit() {
		let id_ka = $("#id_ka_edit").val();
		$.ajax({
			url: '<?= site_url('admin/data_kamar/get_kuota') ?>',
			type: 'GET',
			dataType: 'json',
			data: {
				id_ka: id_ka
			},
			success: function(data) {
				$("#sisa_k_edit").val(data.object.kuota_kamar + " Kamar");
				$("#kuota_tbh4").val(data.object.kuota_kamar);
			},
			error: function(request, status, error) {
				alert('Tidak tersedia');
			}
		})
	}
</script>