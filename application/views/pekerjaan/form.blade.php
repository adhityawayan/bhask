@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-folder"></i> Projects</li>
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
                      Pylon
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg_py!!}
                    <a href="{{base_url('pylon/create/'.$detail->id_p)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-bordered table-striped table-hovered table-pagging">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Kontraktor</th><th>Survey</th><th>Montage</th><th>BAST</th><th>BAPP</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pylon as $t): ?>
                            <tr>
                                <td>{{$t->id_py}}</td>
                                <td>{{$t->nama_b}}<br>Rp {{number_format($t->harga_tukang_b)}}</td>
                                <td>{{$t->survey_py}}</td>
                                <td>
                                    @if($t->montage_py==0)
                                        Pengajuan
                                    @elseif($t->montage_py==1)
                                        Approve
                                    @elseif($t->montage_py==2)
                                        Revisi
                                    @elseif($t->montage_py==3)
                                        Cancel
                                    @endif
                                    <br>
                                    @if($t->file_py)
                                    <a href="{{base_url('uploads/'.$t->file_py)}}" target="_blank">Lihat File</a>
                                    @endif
                                </td>
                                <td>{{$t->bast_py}}</td>
                                <td>{{$t->bapp_py}}</td>
                                <td>
                                    <a href="{{base_url('pylon/edit/'.$t->id_p.'?id_py='.$t->id_py)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{base_url('pylon/delete/'.$t->id_p.'?id_py='.$t->id_py)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      Signange UKER
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg_s!!}
                    <a href="{{base_url('signage/create/'.$detail->id_p)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-bordered table-striped table-hovered table-pagging">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Kontraktor</th><th>Survey</th><th>Montage</th><th>BAST</th><th>BAPP</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($signage as $t): ?>
                            <tr>
                                <td>{{$t->id_s}}</td>
                                <td>{{$t->nama_b}}<br>Rp {{number_format($t->harga_tukang_b)}}</td>
                                <td>{{$t->survey_s}}</td>
                                <td>
                                    @if($t->montage_s==0)
                                        Pengajuan
                                    @elseif($t->montage_s==1)
                                        Approve
                                    @elseif($t->montage_s==2)
                                        Revisi
                                    @elseif($t->montage_s==3)
                                        Cancel
                                    @endif
                                    <br>
                                    @if($t->file_s)
                                    <a href="{{base_url('uploads/'.$t->file_s)}}" target="_blank">Lihat File</a>
                                    @endif
                                </td>
                                <td>{{$t->bast_s}}</td>
                                <td>{{$t->bapp_s}}</td>
                                <td>
                                    <a href="{{base_url('signage/edit/'.$t->id_p.'?id_s='.$t->id_s)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{base_url('signage/delete/'.$t->id_p.'?id_s='.$t->id_s)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      Signange ATM
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg_sa!!}
                    <a href="{{base_url('signage_atm/create/'.$detail->id_p)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-bordered table-striped table-hovered table-pagging">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Kontraktor</th><th>Survey</th><th>Montage</th><th>BAST</th><th>BAPP</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($signage_atm as $t): ?>
                            <tr>
                                <td>{{$t->id_sa}}</td>
                                <td>{{$t->nama_b}}<br>Rp {{number_format($t->harga_tukang_b)}}</td>
                                <td>{{$t->survey_sa}}</td>
                                <td>
                                    @if($t->montage_sa==0)
                                        Pengajuan
                                    @elseif($t->montage_sa==1)
                                        Approve
                                    @elseif($t->montage_sa==2)
                                        Revisi
                                    @elseif($t->montage_sa==3)
                                        Cancel
                                    @endif
                                    <br>
                                    @if($t->file_sa)
                                    <a href="{{base_url('uploads/'.$t->file_sa)}}" target="_blank">Lihat File</a>
                                    @endif
                                </td>
                                <td>{{$t->bast_sa}}</td>
                                <td>{{$t->bapp_sa}}</td>
                                <td>
                                    <a href="{{base_url('signage_atm/edit/'.$t->id_p.'?id_sa='.$t->id_sa)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{base_url('signage_atm/delete/'.$t->id_p.'?id_sa='.$t->id_sa)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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