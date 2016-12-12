@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-bank"></i> BRI</li>
        <li><a href="{{base_url('kantor')}}">Kantor</a></li>
        <li>Detail</li>   
        <li class="active">{{$detail->nama_k}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-wpforms"></i>
                    <h3 class="box-title">
                       Detail "{{$detail->nama_k}}"
                    </h3>
                </div>
                <div class="box-body">
                    <b>Kode Unit Kerja : </b> {{$detail->kode_k}} <br>
                    <b>Jenis Kantor : </b> {{$detail->nama_jk}} <br>
                    <b>Parent : </b> {{$detail->nama_parent}} <br>
                    <b>Nama Kantor : </b> {{$detail->nama_k}} <br>
                    <b>Alamat : </b> {{$detail->alamat_k}} <br>
                    <b>Zona : </b> {{$detail->nama_z}} <br>
                    <b>Status : </b> {{$detail->nama_jk}} <br>
                    
                </div>
            </div>
        </div>
    </div><div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      ATM
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg!!}
                    <a href="{{base_url('atm/create/'.$detail->id_k)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    <table class="table table-bordered table-striped table-hovered table-pagging">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Kode</th><th>Type</th><th>Alamat</th><th width="124px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table as $t): ?>
                            <tr>
                                <td>{{$t->id_a}}</td>
                                <td>{{$t->kode_a}}</td>
                                <td>
                                    @if($t->type_a==1)
                                        On Site
                                    @else
                                        Off Site
                                    @endif
                                </td>
                                <td>{{$t->alamat_a}}</td>
                                <td>
                                    <a href="{{base_url('atm/edit/'.$t->id_k.'?id_a='.$t->id_a)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{base_url('atm/delete/'.$t->id_k.'?id_a='.$t->id_a)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
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