<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Kegiatan Madrasah Diniyah At-Tahdzibiyah </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Kegiatan Ngaji Malam Madin</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
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


				</br>
				</br>
				<div class="col-md-3 form-group">
					<select class="form-control select2" name="filter_jadwal_ngaji" id="filter_jadwal_ngaji" style="width: 100%;">
						<option value="0">Perlihatkan Semua</option>
						<?php foreach ($hari as $row) : ?>
							<option value="<?php echo $row->id_hari ?>"><?php echo $row->nama_hari ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div id="tampil">
					<!-- Data tampil disini -->

				</div>
			</div>

			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Madin</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form-tambah" method='POST' enctype='multipart/form-data'>
								<div class="form-group">
									<label>KELAS</label>
									<select name="id_kelas" id="id_kelas" class="form-control">
										<option value="">Pilih Kelas</option>
										<?php foreach ($kelas as $l) : ?>
											<option value="<?php echo $l->id_kelas ?>"><?php echo $l->nama_kelas ?></option>
										<?php endforeach ?>
									</select>
									<!-- <input type="text" class="form-control" id="nama_s" name="nama_santri" style="background:#d5d8eb;color: #000000;"> -->
								</div>

								<div class="form-group">
									<label>NAMA ASATIDZ </label>
									<input type="text" class="form-control" id="nama_ust" name="nama_ust" style="background:#d5d8eb;color: #000000;">
								</div>

								<div class="form-group">
									<label>NAMA MAPEL</label>
									<select name="id_mapel" id="id_mapel" class="form-control">
										<option value="">Pilih MAPEL</option>
										<?php foreach ($mapel as $m) : ?>
											<option value="<?php echo $m->id_mapel ?>"><?php echo $m->nama_mapel ?></option>
										<?php endforeach ?>
									</select>
								</div>

								<div class="form-group">
									<label>HARI</label>
									<select name="id_hari" id="id_hari" class="form-control">
										<option value="">Pilih Hari</option>
										<?php foreach ($hari as $h) : ?>
											<option value="<?php echo $h->id_hari ?>"><?php echo $h->nama_hari ?></option>
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
		</div>
	</div>
</div>