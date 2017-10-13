<table align="center" width="100%">
	<tr align="center">
		<td width="25%" colspan="2"><img ssrc="vendors/img/bg.jpg width="45%"></td>
		<td width="40%"><b>S U R A T J A L A N <br>No.{{$tglnow}}{{$no_surat}}</b></td>
		<td width="35%">Padang, {{$tgl}}<br><b>Kepada Yth,</b><br><br><br>....................</td>
	</tr>
</table>

<?php
	$i=0
?>

<table align="center" border="1" width="100%">
	<tr align="center">
		<th width="5%">No.</th>
		<th width="20%">Quantity</th>
		<th width="40%">Nama Barang</th>
		<th width="35%">Keterangan</th>
	</tr>
	@foreach($penjualan as $penjualan)
	<tr><td height="25" align="center">{{$i=$i+1}}</td>
		<td align="center">{{$penjualan->qty}}</td>
		<td>{{$penjualan->getBarang ($penjualan->barang_id)}}</td>
		<td></td>
	</tr>
	@endforeach
</table>
<br><br>
<table align="center" width="100%">
	<tr align="center">
		<th colspan="2">Yang Terima,<br><br>..............</th>
		<th>Hormat Kami,<br><br>..............</th>
		<th>Yang Mengantar,<br><br>..............</th>
	</tr>
</table>