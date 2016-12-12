@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
    	<li><i class="fa fa-folder"></i> Repair</li>
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
					 {!!$msg!!}
					<a href="{{base_url('repair/spk/create/')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
					<table class="table table-bordered table-striped table-hovered table-pagging">
						<thead>
							<tr><th width="30px;">ID</th><th>No Pengajuan</th><th>Tanggal Pengajuan</th><th>Nomor</th><th>Tanggal</th><th>Judul</th><th width="230px;">Aksi</th></tr>
						</thead>
						<tbody>
							<?php foreach ($table as $t): ?>
							<tr>
								<td>{{$t->id_repair_spk}}</td>
								<td>{{$t->no_pengajuan_repair_spk}}</td>
								<td>{{$t->tanggal_pengajuan_repair_spk}}</td>
								<td>{{$t->no_repair_spk}}</td>
								<td>{{$t->tanggal_repair_spk}}</td>
								<td>{{$t->judul_repair_spk}}</td>
								<td>
									<!-- <a href="{{base_url('spk/print/'.$t->id_sp)}}" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak</a> -->
									<div class="btn-group">
										<a href="#" class="btn btn-primary"><i class="fa fa-file"></i> Cetak</a>
										<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="{{base_url('repair/spk/spk/'.$t->id_repair_spk)}}"  target="_blank">SPK</a></li>
											<li><a href="{{base_url('repair/spk/bapp/'.$t->id_repair_spk)}}" target="_blank">BAPP</a></li>
											<li><a href="{{base_url('repair/spk/invoice/'.$t->id_repair_spk)}}" target="_blank">INVOICE</a></li>
										</ul>
									</div>
									<a href="{{base_url('repair/spk/edit/'.$t->id_repair_spk)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
									<a href="{{base_url('repair/spk/delete/'.$t->id_repair_spk)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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