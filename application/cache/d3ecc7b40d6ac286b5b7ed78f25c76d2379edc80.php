<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
    	<li><i class="fa fa-folder"></i> Projects</li>
        <li><i class="fa fa-file-o"></i> Laporan</li>
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

					<form class="form-inline">
					<a href="<?php echo e(base_url('laporan/excel/')); ?>" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</a>
					<div class="form-group">
					<input type="text" class="form-control" name="spk" placeholder="Cari SPK">
					</div>
					<button type="submit" class="btn btn-primary">Cari</button>
					</form>
					<br><br>
					<div  style="overflow-x: scroll;">
					<table class="table table-bordered" border="0" cellspacing="0" cellpadding="10">
						<tr align="center"> 
							<th rowspan="3">No</th>
							<th rowspan="3">Kanwil</th>
							<th rowspan="3">Wilayah</th>
							<th rowspan="3">Kode Uker</th>
							<th rowspan="3">Type Kantor</th>
							<th rowspan="3">Nama Kantor</th>
							<th rowspan="3">Alamat</th>
							<th rowspan="3">Zone Price</th>
							<th colspan="13">Pylon</th>
							<th colspan="14">Signage UKER</th>
							<th colspan="17">Signage ATM</th>
							<th colspan="8">SPK</th>
							<th colspan="8">INVOICE</th>
						</tr>
						<tr align="center">
							<th rowspan="2">Survey</th>
							<th rowspan="2">Status Montage</th>
							<th rowspan="2">Type</th>
							<th rowspan="2">Nilai</th>
							<th rowspan="2">Sticker</th>
							<th rowspan="2">Tanggal Pasang</th>
							<th rowspan="2">Foto Pasang</th>
							<th rowspan="2">BAST</th>
							<th rowspan="2">BAPP</th>
							<th colspan="4">Vendor Pasang</th>

							<th rowspan="2">Survey</th>
							<th rowspan="2">Status Montage</th>
							<th colspan="3">Ukuran</th>
							<th rowspan="2">Sticker</th>
							<th rowspan="2">Tanggal Pasang</th>
							<th rowspan="2">Foto Pasang</th>
							<th rowspan="2">BAST</th>
							<th rowspan="2">BAPP</th>
							<th colspan="4">Vendor Pasang</th>

							<th rowspan="2">Survey</th>
							<th rowspan="2">Status Montage</th>
							<th colspan="6">Ukuran</th>
							<th rowspan="2">Sticker</th>
							<th rowspan="2">Tanggal Pasang</th>
							<th rowspan="2">Foto Pasang</th>
							<th rowspan="2">BAST</th>
							<th rowspan="2">BAPP</th>
							<th colspan="4">Vendor Pasang</th>

							<th colspan="2">Permohonan SPK</th>
							<th colspan="2">SPK</th>
							<th>Nilai SPK</th>
							<th>PPH</th>
							<th>PPN</th>
							<th>Nilai Netto</th>

							<th>Nomor</th>
							<th>Tanggal</th>
							<th>Payment</th>
							<th rowspan="2">Tanggal Payment</th>
							<th>Retensi</th>
							<th rowspan="2">Tanggal Retensi</th>
							<th>Total Payment</th>
							<th>Balance</th>
						</tr>
						<tr align="center">
							<th>Tukang</th>
							<th>Harga/Unit</th>
							<th>Payment</th>
							<th>Tanggal Payment</th>

							<th>P</th>
							<th>L</th>
							<th>Nilai</th>
							<th>Tukang</th>
							<th>Nilai</th>
							<th>Payment</th>
							<th>Tanggal Payment</th>

							<th>Depan</th>
							<th>Kanan</th>
							<th>Kiri</th>
							<th>Belakang</th>
							<th>Tinggi</th>
							<th>Nilai</th>
							<th>Tukang</th>
							<th>Nilai</th>
							<th>Payment</th>
							<th>Tanggal Payment</th>

							<th>Tanggal</th>
							<th>Nomor</th>
							<th>Tanggal</th>
							<th>Nomor</th>
							<th></th>
							<th>2%</th>
							<th>10%</th>
							<th></th>

							<th></th>
							<th></th>
							<th>95%</th>
							<th>5%</th>
							<th></th>
							<th></th>
						</tr>

						<?php
							$no = 1;
							foreach ($pekerjaan as $p){ 
								$row = 0;
								$nilai_spk = 0;
								$signage_row = Msignage::where('id_p',$p->id_p)->count();
								$signage_data = Msignage::
												leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
												->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
												->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
												->where('signage.id_p',$p->id_p)
												->get();

								$signage_atm_row = Msignage_atm::where('id_p',$p->id_p)->count();
								$signage_atm_data = Msignage_atm::
												leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
												->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
												->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')

												->where('signage_atm.id_p',$p->id_p)
												->get();

								$pylon_row = Mpylon::where('id_p',$p->id_p)->count();
								$pylon_data = Mpylon::
												leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
												->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
												->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
												->where('pylon.id_p',$p->id_p)
												->get();

								if ($signage_row>$signage_atm_row) {
									$row = $signage_row;
								}else{
									$row = $signage_atm_row;
								}

								if ($row<$pylon_row) {
									$row = $pylon_row;
								}

								for ($i=0; $i < $row; $i++) {
						?>
						<tr valign="top">
							<?php if ($i==0){ ?>
							<td rowspan="<?php echo $row ?>"><?php echo $no; $no++; ?></td>
							<td rowspan="<?php echo $row ?>">
								<?php 
									//Wilayah = 1 || Cabang = 2
									$parent = $p->id_parent;
									// echo $p->id_parent;

									for ($w=0; $w < 10; $w++) { 

										$kantor = Mkantor::select('kantor.id_k',
																	'kantor.id_parent',
																	'kantor.nama_k',
																	'k2.nama_k as nama_parent', 
																	'k2.id_jk as jenis_parent')
															->where('kantor.id_k',$parent)
															->leftjoin('kantor as k2', 'k2.id_k','=','kantor.id_parent')
															->first();
										if ($kantor->jenis_parent==0) {
											$kanwil = $kantor->nama_parent;
											$wilayah = $kantor->nama_k;
											break;
										}
										$parent= $kantor->id_parent;

									}

									if ($kanwil=="") {
										$kanwil = $wilayah;
									}
									echo $kanwil;
								?>
							</td>
							<td rowspan="<?php echo $row ?>"><?php echo $wilayah ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->kode_k ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_jk ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_k ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->alamat_k ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_z ?></td>
							<?php } ?>
							
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->survey_py; ?></td>
							<td>
								<?php 
									if (!empty($pylon_data[$i])){
										$montage = $pylon_data[$i]->montage_py;
										if ($montage==0) {
											echo "Pengajuan";
										}elseif ($montage==1) {
											echo "Approve";
										}elseif ($montage==2) {
											echo "revisi";
										}elseif ($montage==3) {
											echo "Cancel";
										}
									}
								?>
							</td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->kode_b; ?></td>
							<td>
								<?php 
									if (!empty($pylon_data[$i])){
										$harga_bahan = Mharga_bahan::
												where('id_z',$pylon_data[$i]->id_z)
												->where('id_b',$pylon_data[$i]->id_b)
												->first();

										echo number_format($harga_bahan->harga_b);

										// Generate Total Harga Bahan
										for ($j=0; $j < $row; $j++) {
											if (!empty($pylon_data[$j])){
												$harga_bahan = Mharga_bahan::
													where('id_z',$pylon_data[$j]->id_z)
													->where('id_b',$pylon_data[$j]->id_b)
													->first();

												$nilai_spk += $harga_bahan->harga_b;
											}
										}
									}
								?>
							</td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->sticker_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->pemasangan_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->foto_pemasangan_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->bast_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->bapp_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->nama_tukang_py; ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo number_format($pylon_data[$i]->harga_tukang_b); ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo number_format($pylon_data[$i]->payment_py); ?></td>
							<td><?php if (!empty($pylon_data[$i])) echo $pylon_data[$i]->tanggal_payment_py; ?></td>

							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->survey_s ?></td>
							<td>
								<?php 
									if (!empty($signage_data[$i])){
										$montage = $signage_data[$i]->montage_s;
										if ($montage==0) {
											echo "Pengajuan";
										}elseif ($montage==1) {
											echo "Approve";
										}elseif ($montage==2) {
											echo "revisi";
										}elseif ($montage==3) {
											echo "Cancel";
										}
									}
								?>
							</td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->panjang_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->lebar_s ?></td>
							<td>
								<?php 
									if (!empty($signage_data[$i])){
										$harga_bahan = Mharga_bahan::
												where('id_z',$signage_data[$i]->id_z)
												->where('id_b',$signage_data[$i]->id_b)
												->first();

										echo number_format($signage_data[$i]->panjang_s*$signage_data[$i]->lebar_s*$harga_bahan->harga_b);

										// Generate Total Harga Bahan
										for ($j=0; $j < $row; $j++) {
											if (!empty($signage_data[$j])){
												$harga_bahan = Mharga_bahan::
													where('id_z',$signage_data[$j]->id_z)
													->where('id_b',$signage_data[$j]->id_b)
													->first();

												$nilai_spk += $signage_data[$j]->panjang_s*$signage_data[$j]->lebar_s*$harga_bahan->harga_b;
											}
										}
									}
								?>
							</td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->sticker_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->pemasangan_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->foto_pemasangan_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->bast_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->bapp_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->nama_tukang_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo number_format($signage_data[$i]->harga_tukang_b) ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->payment_s ?></td>
							<td><?php if (!empty($signage_data[$i])) echo $signage_data[$i]->tanggal_payment_s ?></td>

							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->survey_sa ?></td>
							<td>
								<?php 
									if (!empty($signage_atm_data[$i])){
										$montage = $signage_atm_data[$i]->montage_sa;
										if ($montage==0) {
											echo "Pengajuan";
										}elseif ($montage==1) {
											echo "Approve";
										}elseif ($montage==2) {
											echo "revisi";
										}elseif ($montage==3) {
											echo "Cancel";
										}
									}
								?>
							</td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->depan_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->kanan_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->kiri_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->belakang_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->tinggi_sa ?></td>
							<td>
								<?php 
									if (!empty($signage_atm_data[$i])){
										$harga_bahan = Mharga_bahan::
												where('id_z',$signage_atm_data[$i]->id_z)
												->where('id_b',$signage_atm_data[$i]->id_b)
												->first();

										echo number_format(($signage_atm_data[$i]->depan_sa+$signage_atm_data[$i]->kanan_sa+$signage_atm_data[$i]->kiri_sa+$signage_atm_data[$i]->belakang_sa)*$harga_bahan->harga_b);

										// Generate Total Harga Bahan
										for ($j=0; $j < $row; $j++) {
											if (!empty($signage_atm_data[$j])){
											$harga_bahan = Mharga_bahan::
												where('id_z',$signage_atm_data[$j]->id_z)
												->where('id_b',$signage_atm_data[$j]->id_b)
												->first();

											$nilai_spk += ($signage_atm_data[$j]->depan_sa+$signage_atm_data[$j]->kanan_sa+$signage_atm_data[$j]->kiri_sa+$signage_atm_data[$j]->belakang_sa)*$harga_bahan->harga_b;
											}
										}
									}
								?>
							</td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->sticker_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->pemasangan_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->foto_pemasangan_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->bast_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->bapp_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->nama_tukang_sa ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo number_format($signage_atm_data[$i]->harga_tukang_b) ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo number_format($signage_atm_data[$i]->payment_sa) ?></td>
							<td><?php if (!empty($signage_atm_data[$i])) echo $signage_atm_data[$i]->tanggal_payment_sa ?></td>
							<?php if ($i==0){ ?>
							<?php 
								$spk = Mrsp::
										where('id_p',$p->id_p)
										->leftjoin('spk', 'spk.id_sp','=','r_sp.id_sp')
										->first();
							?>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_pengajuan_sp ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_pengajuan_sp ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_sp ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_sp ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($nilai_spk); $hpp = $nilai_spk/1.1; ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($pph=($hpp*(2/100))) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($ppn=($hpp*(10/100))) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($neto = $nilai_spk-$pph-$ppn) ?></td>

							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_invoice ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_invoice ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($retensi95 = ($nilai_spk * 95/100)-$ppn-$pph) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_payment_invoice ?></td>
							<!-- <td rowspan="<?php echo $row ?>"><?php echo number_format(($nilai_spk-($hpp*(2/100)))*(95/100)) ?></td> -->
							<td rowspan="<?php echo $row ?>"><?php echo number_format($retensi5 = ($nilai_spk * 5/100)) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_retensi_invoice ?></td>
							<!-- <td rowspan="<?php echo $row ?>"><?php echo number_format(($nilai_spk-($hpp*(2/100)))*(5/100)) ?></td> -->
							<td rowspan="<?php echo $row ?>"><?php echo number_format($totalpay = $retensi95+$retensi5) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($balance = $neto-$totalpay) ?></td>
							<?php } ?>

							<?php } ?>
							<?php } ?>
						</tr>
					</table>
					<?php echo $pagination; ?>
					</div>
				</div>
			</div>			
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>