@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
    	<li><i class="fa fa-folder"></i> Repair</li>
        <li><i class="fa fa-briefcase"></i> Pekerjaan</li>
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
					<a href="{{base_url('repair/pekerjaan/create/')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
					<table class="table table-bordered table-striped table-hovered table-pagging">
						<thead>
							<tr><th width="30px;">ID</th><th>Kantor</th><th>Created at</th><th width="310px;">Aksi</th></tr>
						</thead>
						<tbody>
							<?php foreach ($table as $t): ?>
							<tr>
								<td>{{$t->id_repair_pekerjaan}}</td>
								<td>{{$t->nama_k}}</td>
								<td>{{$t->created_at}}</td>
								<td>
									<div class="btn-group">
										<a href="#" class="btn btn-primary"><i class="fa fa-file"></i> Cetak</a>
										<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="{{base_url('repair/pekerjaan/bast/'.$t->id_repair_pekerjaan)}}" target="_blank">BAST</a></li>
										</ul>
									</div>
									<a href="{{base_url('repair/pekerjaan/edit/'.$t->id_repair_pekerjaan)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
									<a href="{{base_url('repair/pekerjaan/delete/'.$t->id_repair_pekerjaan)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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