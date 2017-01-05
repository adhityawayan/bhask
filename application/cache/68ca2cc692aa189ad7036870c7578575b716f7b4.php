<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
    	<li><i class="fa fa-folder"></i> Projects</li>
        <li><i class="fa fa-wpforms"></i> SPK</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      Index
                    </h3>
                </div>
				<div class="box-body">
					 <?php echo $msg; ?>

					<a href="<?php echo e(base_url('spk/create/')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
					<table class="table table-bordered table-striped table-hovered table-pagging">
						<thead>
							<tr><th width="30px;">ID</th><th>No Pengajuan</th><th>Tanggal Pengajuan</th><th>Nomor</th><th>Tanggal</th><th>Judul</th><th width="230px;">Aksi</th></tr>
						</thead>
						<tbody>
							<?php foreach ($table as $t): ?>
							<tr>
								<td><?php echo e($t->id_sp); ?></td>
								<td><?php echo e($t->no_pengajuan_sp); ?></td>
								<td><?php echo e($t->tanggal_pengajuan_sp); ?></td>
								<td><?php echo e($t->no_sp); ?></td>
								<td><?php echo e($t->tanggal_sp); ?></td>
								<td><?php echo e($t->judul_sp); ?></td>
								<td>
									<!-- <a href="<?php echo e(base_url('spk/print/'.$t->id_sp)); ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak</a> -->
									<div class="btn-group">
										<a href="#" class="btn btn-primary"><i class="fa fa-file"></i> Cetak</a>
										<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo e(base_url('spk/spk/'.$t->id_sp)); ?>"  target="_blank">SPK</a></li>
											<li><a href="<?php echo e(base_url('spk/bapp/'.$t->id_sp)); ?>" target="_blank">BAPP</a></li>
											<li><a href="<?php echo e(base_url('spk/invoice/'.$t->id_sp)); ?>" target="_blank">INVOICE</a></li>
										</ul>
									</div>
									<a href="<?php echo e(base_url('spk/edit/'.$t->id_sp)); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
									<a href="<?php echo e(base_url('spk/delete/'.$t->id_sp)); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>