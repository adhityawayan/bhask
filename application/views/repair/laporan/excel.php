<!DOCTYPE html>
<html>
<head>
	<title>Export</title>
</head>
<body>
<table border="1" cellspacing="0" cellpadding="10">
	<tr align="center"> 
		<th rowspan="3">No</th>
		<th rowspan="3">Kanwil</th>
		<th rowspan="3">Wilayah</th>
		<th rowspan="3">Kode Uker</th>
		<th rowspan="3">Type Kantor</th>
		<th rowspan="3">Nama Kantor</th>
		<th rowspan="3">Alamat</th>
		<th rowspan="3">Zone Price</th>
		<th colspan="13">Detail</th>
		<th colspan="8">SPK</th>
		<th colspan="4">INVOICE</th>
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

		<th colspan="2">Permohonan SPK</th>
		<th colspan="2">SPK</th>
		<th>Nilai SPK</th>
		<!-- <th>PPH</th>
		<th>PPN</th> -->
		<th>Nilai Netto</th>

		<th>Nomor</th>
		<th>Tanggal</th>
		<th>Payment</th>
		<th rowspan="2">Tanggal Payment</th>
		<th>Total Payment</th>
		<th>Balance</th>
	</tr>
	<tr align="center">
		<th>Tukang</th>
		<th>Harga/Unit</th>
		<th>Payment</th>
		<th>Tanggal Payment</th>

		<th>Tanggal</th>
		<th>Nomor</th>
		<th>Tanggal</th>
		<th>Nomor</th>
		<th></th>
		<!-- <th>2%</th>
		<th>10%</th> -->
		<th></th>

		<th></th>
		<th></th>
		<th>100%</th>
		<!-- <th>5%</th> -->
		<th></th>
		<th></th>
	</tr>

	<?php
		$no     = 1;
		$i_test = 0;
		foreach ($pekerjaan as $p){ 
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
		
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->survey_repair_detail; ?></td>
		<td>
			<?php 
				if (!empty($detail_data[$i_test])){
					$montage = $detail_data[$i_test]->montage_repair_detail;
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
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->kode_repair_subkon; ?></td>
		<td>
			<?php 
				if (!empty($detail_data[$i_test])){
					$harga = Mrepairharga::
							where('id_z',$detail_data[$i_test]->id_z)
							->where('id_repair_subkon',$detail_data[$i_test]->id_repair_subkon)
							->first();

					echo $harga->harga_repair_harga;

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
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->sticker_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->pemasangan_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->foto_pemasangan_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->bast_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->bapp_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->nama_tukang_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->harga_repair_subkon; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->payment_repair_detail; ?></td>
		<td><?php if (!empty($detail_data[$i_test])) echo $detail_data[$i_test]->tanggal_payment_repair_detail; ?></td>

		
		<?php if ($i==0){ ?>
		<?php 
			$spk = Mrepairrelasispk::
				where('id_repair_pekerjaan',$p->id_repair_pekerjaan)
				->leftjoin('repair_spk', 'repair_spk.id_repair_spk','=','repair_relasi_spk.id_repair_spk')
				->first();
		?>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_pengajuan_repair_spk ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->no_pengajuan_repair_spk ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_repair_spk ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->no_repair_spk ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo round($nilai_spk); $hpp = $nilai_spk ?></td>
<!-- 		<td rowspan="<?php echo $row ?>"><?php echo round($pph=($hpp*(2/100))) ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo round($ppn=($hpp*(10/100))) ?></td-->
		<td rowspan="<?php echo $row ?>"><?php echo round($neto = $nilai_spk) ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->no_invoice ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_invoice ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo round($retensi100 = $nilai_spk) ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo $spk->tanggal_payment_invoice_repair_spk?></td>
		<td rowspan="<?php echo $row ?>"><?php echo round($totalpay = $retensi100) ?></td>
		<td rowspan="<?php echo $row ?>"><?php echo round($balance = $totalpay) ?></td>
					<?php } ?>
				</tr>
			<?php $i_test=$i;} ?>
		<?php $i_test++; } ?>
	</tr>
</table>
</body>
</html>