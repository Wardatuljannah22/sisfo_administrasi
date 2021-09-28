<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Santri</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Biodata Santri</h6>
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
				<a data-toggle="modal" data-target="#modal-upload" class="btn btn-info btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-file-import"></i>
					</span>
					<span class="text">Import Excel</span>
				</a>

				&nbsp;
				<a data-toggle="modal" data-target="#modal-multiple" class="btn btn-warning btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-file-upload"></i>
					</span>
					<span class="text">Upload Multiple Photos Santri</span>
				</a>

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
			<!-- modal tambah data -->


			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form-tambah" method="post">
								<div class="form-group">
									<label>NIS</label>
									<input type="text" class="form-control" id="nis" name="nis" style="background:#d5d8eb;color: #000000;">
								</div>
								<div class="form-group">
									<label>Nama Santri</label>
									<input type="text" class="form-control" id="nama_santri" name="nama_santri" style="background:#d5d8eb;color: #000000;">
								</div>

								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" style="background:#d5d8eb;color: #000000;">
								</div>

								<div class="form-group">
									<label> Tanggal Lahir</label>
									<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" style="background:#d5d8eb;color: #000000;">
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select name="jenis_kelamin" class="form-control">
										<option value="">--Pilih Jenis Kelamin--</option>
										<option value="L">Laki-laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" class="form-control" id="alamat" name="alamat" style="background:#d5d8eb;color: #000000;">
								</div>
								<div class="form-group">
									<label>Jurusan</label>
									<input type="text" class="form-control" id="jurusan" name="jurusan" style="background:#d5d8eb;color: #000000;">
								</div>
								<div class="form-group">
									<label>Asal Universitas</label>
									<select name="id_univ" class="form-control">
										<option value="">Pilih Universitas</option>
										<?php foreach ($univ as $u) : ?>
											<option value="<?php echo $u->id_univ ?>"><?php echo $u->nama_univ ?></option>
										<?php endforeach ?>
									</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
								</div>

								<div class="form-group">
									<label>Nama Angkatan</label>
									<select name="id_angk" class="form-control">
										<option value="">Pilih Angkatan</option>
										<?php foreach ($nama_angkatan as $a) : ?>
											<option value="<?php echo $a->id_angk ?>"><?php echo $a->nama_angk ?></option>
										<?php endforeach ?>
									</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
								</div>
								<div class="form-group">
									<label>Status</label>
									<select name="id_status" class="form-control">
										<option value="">Pilih Status</option>
										<?php foreach ($status as $a) { ?>
											<option value="<?php echo $a->id_status ?>"><?php echo $a->nama_status ?></option>
										<?php } ?>
									</select>
									<!-- <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" style="background:#d5d8eb;color: #000000;"> -->
								</div>
								<div class="form-group">
									<label for="pic_file">Foto*:</label>
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
		</div>
	</div>
</div>