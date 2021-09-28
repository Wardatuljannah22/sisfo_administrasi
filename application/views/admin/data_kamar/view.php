<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Kamar</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Data Kamar</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<!-- data-toggle="modal" : Mengarahkan ke modal 
				data-target :"#modal-tambah" : buka modal dengan id='modal_tambah' 
				untuk edit sesuaikan-->
				<a data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-plus"></i>
					</span>
					<span class="text">Tambah Data</span>
				</a>

				&nbsp;

				</br>
				</br>
				<div class="col-md-3 form-group">
					<select class="form-control" name="filter_j_kelamin" id="filter_j_kelamin" style="width: 100%;">
						<option value="0">Perlihatkan Semua</option>
						<option value="L">Laki-Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>



				<!-- Ganti div dengan table lood ajax -->
				<div id="tampil">
					<!-- Data tampil disini -->
				</div>
			</div>
		</div>
		<!-- modal tambah data -->


		<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Data Kamar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form-tambah" method='POST' enctype='multipart/form-data'>
							<input type="hidden" id="kuota_tbh3" />
							<div class="form-group">
								<select name="id_ka" onchange="myKuota()" id="id_ka_tbh" class="form-control">
									<option value="">Pilih Kamar</option>
									<?php foreach ($nama_kamar as $a) { ?>
										<option value="<?php echo $a->id_ka ?>"><?php echo $a->nama_ka ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Kuota Orang</label>
								<input type="text" class="form-control" id="sisa_k" name="sisa_k" style="background:#d5d8eb;color: #000000;" disabled="disabled">
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
								<input type="number" min='1' class="form-control" id="kuota_ka_tbh" name="kuota_ka" style="background:#d5d8eb;color: #000000;">
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
	</div>