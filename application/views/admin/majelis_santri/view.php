<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Majelis Santri</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tabel Majelis Santri</h6>
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
							<h5 class="modal-title" id="exampleModalLabel">Form Tambah Majelis Santri</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form-tambah" method='POST' enctype='multipart/form-data'>
								<div class="form-group">
									<label>NIS</label>
									<select class="form-control select2" onchange="myNisTbh()" name="nis_ms" id="nistbh" style="width: 100%;">
										<option value="">Pilih Santri</option>
										<?php foreach ($biodata_santri as $jb) : ?>
											<option value="<?php echo $jb->nis ?>"><?php echo $jb->nis . '-' . $jb->nama_santri ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<input type="text" class="form-control" id="jk_tbh" name="jk_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
								</div>
								<div class="form-group">
									<label>Nama Angkatan</label>
									<input type="text" class="form-control" id="angkatan_tbh" name="angkatan_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
								</div>
								<div class="form-group">
									<label>Asal Universitas</label>
									<input type="text" class="form-control" id="universitas_tbh" name="universitas_tbh" style="background:#d5d8eb;color: #000000;" disabled="disabled">
								</div>
								<div class="form-group">
									<label>Jabatan</label>
									<select name="id_jabatan" id="jabatantbh" class="form-control select2" style="width: 100%;">
										<option value="">Pilih Jabatan</option>
										<?php foreach ($jabatan_ms as $jb) : ?>
											<option value="<?php echo $jb->id_jabatan ?>"><?php echo $jb->nama_jabatan ?></option>
										<?php endforeach ?>
									</select>
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