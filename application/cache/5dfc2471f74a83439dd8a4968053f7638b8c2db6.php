<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</li>
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
					<h1>Welcome to management bhaskara proyek apps.</h1>
				</div>
			</div>			
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>