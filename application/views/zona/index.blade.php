@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-globe"></i> Zona</li>
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
					 {!!$msg!!}
					<a href="{{base_url('zona/create/')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
					<table class="table table-bordered table-striped table-hovered table-pagging">
						<thead>
							<tr><th width="30px;">ID</th><th>Zona</th><th>Deskripsi</th><th width="130px;">Aksi</th></tr>
						</thead>
						<tbody>
							<?php foreach ($table as $t): ?>
							<tr>
								<td>{{$t->id_z}}</td>
								<td>{{$t->nama_z}}</td>
								<td>{{$t->deskripsi_z}}</td>
								<td>
									<a href="{{base_url('zona/edit/'.$t->id_z)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
									<a href="{{base_url('zona/delete/'.$t->id_z)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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
@endsection