<table class="table table-bordered" id="data_kamar" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>NO</th>
			<th>NAMA KAMAR</th>
			<th>NAMA PENGHUNI</th>
			<th>JENIS KELAMIN</th>
			<th>KUOTA KAMAR</th>
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
				<form id="form-edit-role" method='POST' enctype='multipart/form-data'>

					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" id="name" name="name" style="background:#d5d8eb;color: #000000;" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" id="email" name="email" style="background:#d5d8eb;color: #000000;" disabled="disabled">
					</div>

					<div class="form-group">
						<label>NIS </label>
						<input type="text" class="form-control" id="nis" name="nis" style="background:#d5d8eb;color: #000000;" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Pilih Role</label>
						<select name="edit_role" id="edit_role" class="form-control">
							<option value="">--Pilih Role--</option>
							<option value="">Admin Sekretaris</option>
							<option value="">Admin Peribadatan</option>
							<option value="">User (Santri)</option>
						</select>
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


<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data Santri</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>

<script>
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
				$("#form-edit-role input[name='id']").val(data.object.id_role);

				modal_edit.modal('show').on('shown.bs.modal', function(e) {
					$("#form-edit-role input[name='id_role']").focus();
				});
			});
	});

	//Proses Update ke Db
	$("#form-edit-role").submit(function(e) {
		e.preventDefault();
		form = $(this);
		$.ajax({
			url: '<?= site_url('role/edit_role/crud/update') ?>',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function(data) {
				form[0].reset();
				modal_edit.modal('hide');
				swal("Berhasil!", "Data Role berhasil diedit.", "success");
				$('#user').DataTable().clear().destroy();
				refresh_table();
			},
			error: function(response) {
				alert(response);
			}
		})
	});
</script>