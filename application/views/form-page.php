<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
	<div class="container my-5 mx-auto">
		<div class="row align-items-center">
			<?= form_open_multipart('home/process') ?>
                <div class="card">
                    <div class="card-header">
                        <h1>Form <?= $submit == 'edit' ? 'Edit' : 'Tambah' ?> Identitas</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
							<label for="nama">Nama</label>
							<input type="hidden" name="id" value="<?= $i->id ?>">
							<input type="text" name="nama" class="form-control" id="nama" value="<?= $i->nama ?>" required>
						</div>
						<div class="form-group mb-3">
							<label for="r">Nama</label>
							<input type="range" name="narma" class="form-control" id="r" required>
						</div>
						<div class="form-group mb-3">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
								<option value="">--Pilih--</option>
								<option value="1" <?= $i->jenis_kelamin == 1 ? 'selected' : null ?>>Pria</option>
								<option value="2" <?= $i->jenis_kelamin == 2 ? 'selected' : null ?>>Wanita</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= $i->tanggal_lahir ?>" required>
						</div>
						<div class="form-group mb-3">
							<label for="alamat">Alamat</label>
							<textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required><?= $i->alamat ?></textarea>
						</div>
						<div class="form-group mb-3">
							<label for="foto">Foto</label>
							<?php if($submit == 'edit') {
								if($i->foto != null) { ?>
							<div class="mb-3">
								<img src="<?= base_url('uploads/'.$i->foto) ?>" alt="" style="width: 100px;">
							</div>
							<?php } 
							} ?>
							<input type="file" name="foto" class="form-control" id="foto">
							<small class="text-danger">Biarkan Kosong Jika <?= $submit == 'edit' ? "Tidak Ingin Diubah" : 'Tidak ada Foto'?></small>
						</div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="<?= $submit ?>">Save</button>
						<button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>	
			<?= form_close() ?>
		</div>
	</div>	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>