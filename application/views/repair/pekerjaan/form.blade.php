@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-folder"></i> Repair</li>
        <li><i class="fa fa-briefcase"></i> Pekerjaan</li>
        <li class="active">{{$title}}</li>   
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-wpforms"></i>
                    <h3 class="box-title">
                       Form
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg!!}

                    {!!$form!!}
                    
                </div>
            </div>
        </div>
    </div>
    <?php if ($title=='Edit Pekerjaan'): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      Detail
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg_py!!}
                    <a href="{{base_url('repair/detail/create/'.$detail->id_repair_pekerjaan)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-bordered table-striped table-hovered table-pagging">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Kontraktor</th><th>Survey</th><th>Montage</th><th>BAST</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($repair_detail as $t): ?>
                            <tr>
                                <td>{{$t->id_repair_detail}}</td>
                                <td>{{$t->nama_repair_subkon}}<br>Rp {{number_format($t->harga_repair_subkon)}}</td>
                                <td>{{$t->survey_repair_detail}}</td>
                                <td>
                                    @if($t->montage_repair_detail==0)
                                        Pengajuan
                                    @elseif($t->montage_repair_detail==1)
                                        Approve
                                    @elseif($t->montage_repair_detail==2)
                                        Revisi
                                    @elseif($t->montage_repair_detail==3)
                                        Cancel
                                    @endif
                                    <br>
                                    @if($t->file_repair_detail)
                                    <a href="{{base_url('uploads/'.$t->file_repair_detail)}}" target="_blank">Lihat File</a>
                                    @endif
                                </td>
                                <td>{{$t->bast_repair_detail}}</td>
                                <td>
                                    <a href="{{base_url('repair/detail/edit/'.$t->id_repair_pekerjaan.'?id_repair_detail='.$t->id_repair_detail)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{base_url('repair/detail/delete/'.$t->id_repair_pekerjaan.'?id_repair_detail='.$t->id_repair_detail)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</section>
@endsection