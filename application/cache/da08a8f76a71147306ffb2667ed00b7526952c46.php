<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
    	<li><i class="fa fa-folder"></i> Repair</li>
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
					<a href="<?php echo e(base_url('repair/laporan/excellaporantukang/')); ?>" class="btn btn-primary"><i class="fa fa-print"></i> Export Excel</a>
					<div class="form-group">
					<input type="text" class="form-control" name="spk" placeholder="Cari SPK">
					</div>
					<button type="submit" class="btn btn-primary">Cari</button>
					</form>
					<br><br>
					<div style="overflow-x: scroll;" >
					<table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">
						<tr align="center"> 
							<th rowspan="3">No</th>
							<th rowspan="3">Kanwil</th>
							<!-- <th rowspan="3">Wilayah</th>
							<th rowspan="3">Kode Uker</th>
							<th rowspan="3">Type Kantor</th> -->
							<th rowspan="3">Nama Kantor</th>
							<!-- <th rowspan="3">Alamat</th>
							<th rowspan="3">Zone Price</th> -->
							<th colspan="3">Detail</th>
							<th colspan="1">SPK</th>
							<!-- <th colspan="8">INVOICE</th> -->
						</tr>
						<tr align="center">
							<!-- <th rowspan="2">Survey</th>
							<th rowspan="2">Status Montage</th>
							<th rowspan="2">Type</th>
							<th rowspan="2">Nilai</th>
							<th rowspan="2">Sticker</th>
							<th rowspan="2">Tanggal Pasang</th>
							<th rowspan="2">Foto Pasang</th>
							<th rowspan="2">BAST</th>
							<th rowspan="2">BAPP</th> -->
							<th colspan="3">Vendor Pasang</th>

							<!-- <th colspan="2">Permohonan SPK</th> -->
							<th colspan="1">SPK</th>
							<!-- <th>Nilai SPK</th> -->
							<!-- <th>PPH</th>
							<th>PPN</th> --> 
							<!-- <th>Nilai Netto</th> -->

							<!-- <th>Nomor</th> -->
							<!-- <th>Tanggal</th>
							<th>Payment</th>
							<th rowspan="2">Tanggal Payment</th>
							<th>Total Payment</th>
							<th>Balance</th> -->
						</tr>
						<tr align="center">
							<th>Tukang</th>
							<!-- <th>Harga/Unit</th> -->
							<th>Payment</th>
							<th>Tanggal Payment</th>

							<!-- <th>Tanggal</th-->
							<th>Nomor</th>
							<!--th>Tanggal</th>
							<th>Nomor</th>
							<th></th> -->
							<!-- <th>2%</th>
							<th>10%</th> -->
							<!-- <th></th>

							<th></th>
							<th></th> -->
							<!-- <th>100%</th> -->
							<<!-- th></th>
							<th></th> -->
						</tr>

						<?php
							$no  = 1;
							$i_test  = 0;
							foreach ($pekerjaan as $p) {
								$row = 0;
								$nilai_spk = 0;
								$detail_row = Mrepairdetail::where('id_repair_pekerjaan',$p->id_repair_pekerjaan)->count();
								$detail_data = Mrepairdetail::
												leftjoin('repair_subkon', 'repair_subkon.id_repair_subkon','=','repair_detail.id_repair_subkon')
												->leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_pekerjaan.id_repair_pekerjaan')
												->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
												->where('repair_pekerjaan.id_repair_pekerjaan',$p->id_repair_pekerjaan)
												->get();

								if ($row<$detail_row) {
									$row = $detail_row;
								}

								for ($i=0; $i < $row; $i++) { ?>
									<tr valign="top">
										<?php if ($i==0) { ?>
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
											<!-- <td rowspan="<?php echo $row ?>"><?php echo $wilayah ?></td> -->
							<!-- <td rowspan="<?php echo $row ?>"><?php echo $p->kode_k ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_jk ?></td> -->
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_k ?></td>
							<!-- <td rowspan="<?php echo $row ?>"><?php echo $p->alamat_k ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $p->nama_z ?></td> -->
										<?php } ?>
										
										<!-- <td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->survey_repair_detail; ?></td>
							<td>
								<?php 
									if (!empty($detail_data[$i])){
										$montage = $detail_data[$i]->montage_repair_detail;
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
							<td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->kode_repair_subkon; ?></td>
							<td>
								<?php 
									if (!empty($detail_data[$i])){
										$harga = Mrepairharga::
												where('id_z',$detail_data[$i]->id_z)
												->where('id_repair_subkon',$detail_data[$i]->id_repair_subkon)
												->first();

										echo number_format($harga->harga_repair_harga);

										// Generate Total Harga Bahan
										for ($j=0; $j < $row; $j++) {
											if (!empty($detail_data[$j])){
												$harga = Mrepairharga::
													where('id_z',$detail_data[$j]->id_z)
													->where('id_repair_subkon',$detail_data[$j]->id_repair_subkon)
													->first();

												$nilai_spk += $harga->harga_repair_harga;
											}
										}
									}
								?>
							</td>
										<td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->sticker_repair_detail; ?></td-->
							<!--td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->pemasangan_repair_detail; ?></td>
							<td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->foto_pemasangan_repair_detail; ?></td>
							<td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->bast_repair_detail; ?></td>
							<td><?php if (!empty($detail_data[$i])) echo $detail_data[$i]->bapp_repair_detail; ?></td> -->
							<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->nama_tukang_repair_detail; ?></td>
							<!-- <td><?php if (!empty($detail_data[$i])) echo number_format($detail_data[$i]->harga_repair_subkon); ?></td> -->
							<td><?php if (!empty($detail_data[$i_test])) echo number_format($detail_data[$i_test]->payment_repair_detail); ?></td>
							<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->tanggal_payment_repair_detail; ?></td>
										
										<?php if ($i==0){ ?>
											<?php 
												$spk = Mrepairrelasispk::
														where('id_repair_pekerjaan',$p->id_repair_pekerjaan)
														->leftjoin('repair_spk', 'repair_spk.id_repair_spk','=','repair_relasi_spk.id_repair_spk')
														->first();
											?>
											<!-- <td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_pengajuan_repair_spk ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_pengajuan_repair_spk ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_repair_spk ?></td> -->
							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_repair_spk ?></td>
							<!-- <td rowspan="<?php echo $row ?>"><?php echo number_format($nilai_spk); $hpp = $nilai_spk; ?></td>
							<!-- <td rowspan="<?php echo $row ?>"><?php echo number_format($pph=($hpp*(2/100))) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($ppn=($hpp*(10/100))) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($neto = $nilai_spk) ?></td>

							<td rowspan="<?php echo $row ?>"><?php echo $spk->no_invoice ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_invoice ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($retensi100 = $nilai_spk) ?></td>

							<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_payment_invoice_repair_spk ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format(($nilai_spk-($hpp*(2/100)))*(5/100)) ?></td> 
							<td rowspan="<?php echo $row ?>"><?php echo number_format($totalpay = $nilai_spk) ?></td>
							<td rowspan="<?php echo $row ?>"><?php echo number_format($balance = $nilai_spk) ?></td> -->
										<?php } ?>
									</tr>
								<?php $i_test=$i;} ?>
							<?php $i_test++; } ?>
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