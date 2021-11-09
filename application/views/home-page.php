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
			<div class="col-md-4 mb-5">
				<a href="<?= base_url('home/form') ?>" class="btn btn-primary">Tambah Identitas</a>
			</div>
			<div class="col-md-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Tanggal Lahir</th>
							<th>Alamat</th>
							<th>Created At</th>
							<th>Foto</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $index = 1; ?>
						<?php foreach($identitas as $i) { ?>
						<tr>
							<th><?= $index++ ?></th>
							<td><?= $i->nama ?></td>
							<td><?= ($i->jenis_kelamin == 1) ? 'Pria' : 'Wanita' ?></td>
							<td><?= $i->tanggal_lahir ?></td>
							<td><?= $i->alamat ?></td>
							<td><?= $i->created_at ?></td>
							<td>
								<?php if($i->foto != null) { ?>
									<img src="<?= base_url('uploads/'.$i->foto) ?>" alt="" style="width: 50px;">
								<?php } ?>
							</td>
							<td>
								<a href="<?= base_url('home/edit/'.$i->id) ?>" class="btn btn-success btn-xs">Edit</a>
								<a href="<?= base_url('home/delete/'.$i->id) ?>" class="btn btn-danger btn-xs">Delete</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>