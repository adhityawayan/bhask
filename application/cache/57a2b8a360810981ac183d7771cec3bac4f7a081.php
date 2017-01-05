<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-bank"></i> Kantor/ATM BRI</li>
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

					<a href="<?php echo e(base_url('kantor/create/')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
					<table class="table table-bordered table-striped table-hovered table-pagging">
						<thead>
							<tr><th width="30px;">ID</th><th>Kode Uker</th><th>Jenis Kantor/ATM</th><th>Top Kantor</th><th>Nama Kantor/ATM</th><th>Lokasi</th><th>Zona</th><th>Status</th><th width="130px;">Aksi</th></tr>
						</thead>
						<tbody>
							<?php foreach ($table as $t): ?>
							<tr>
								<td><?php echo e($t->id_k); ?></td>
								<td><?php echo e($t->kode_k); ?></td>
								<td><?php echo e($t->nama_jk); ?></td>
								<td><?php echo e($t->nama_parent); ?></td>
								<td><?php echo e($t->nama_k); ?></td>
								<td><?php echo e($t->alamat_k); ?></td>
								<td><?php echo e($t->nama_z); ?></td>
								<td>
									<?php if($t->status_k==1): ?>
										Aktif
									<?php else: ?>
										Tidak Aktif
									<?php endif; ?>
								</td>
								<td>
									<a href="<?php echo e(base_url('kantor/edit/'.$t->id_k)); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
									<a href="<?php echo e(base_url('kantor/delete/'.$t->id_k)); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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