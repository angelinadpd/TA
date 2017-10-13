<table align="center" width="100%">
	<tr align="center">
		<th colspan="2">F A K T U R   P E N J U A L A N</th>
	</tr>
		<tr align="center">
		<td colspan="2">No Faktur : {{$tglnow}}{{$no_faktur}}</td>
	</tr>
	<tr align="left">
		<td width="50%"><b><br><br>PT. BAKS</b><br>Jl. Gurun Laweh No. 3G & 3H<br>Telp. 0751 841174</td>
		<td width="50%"><b><br><br>Kepada Yth :</b>{{$nama}}<br><br><br></td>
	</tr>	
</table>
<hr>
<table align="center" width="100%">
	<tr>
		<td>Tanggal : {{$tgl}}</td>
		<td>Operator : {{ $operator }}</td>
	</tr>
</table>
<hr>
<hr>

<?php
	$i=0
?>

<table align="center" width="100%" border="1">
	<tr>
		<th align="center">No.</th>
		<th align="center">Nama Barang</th>
		<th align="center">QTY</th>
		<th align="center">Harga</th>
		<th align="center">Total</th>
	</tr>
	@foreach($penjualan as $penjualan)
	<tr align="left">
		<td align="center">{{$i=$i+1}}</td>
		<td>{{$penjualan->getBarang($penjualan->barang_id)}}</td>
		<td align="center">{{$penjualan->qty}}</td>
		<td align="right">Rp.{{$penjualan->price}}</td>
		<td align="right">Rp.{{$penjualan->amount}}</td>
	</tr>
	@endforeach
</table>
<br>
<hr>
<hr>
<table align="center" width="100%" >
	<tr align="right">
		<th colspan="4">Diskon (Rp.) </th>
		<th>{{$diskon}},-</th>
	</tr>
	<tr align="right">
		<th colspan="4">Grand Total (Rp.) </th>
		<th>{{$total}},-</th>
	</tr>
</table>
<br><br>
<table align="center" width="100%" bgcolor="#c7bebe">
	<tr>
		<td><b><i>Terbilang : {{$terbilang->terbilang($total)}} rupiah.</b></i></td>
	</tr>
</table>
<br><br>
<table align="center" width="100%">
	<tr align="center">
		<td width="30%"><b>Penerima</b><br><br><br><i>Tanda Tangan & Stempel</i></td>
		<td width="30%"><b>Hormat Kami,</b><br><br><br><i>Tanda Tangan & Stempel</i></td>
		<td width="40%"></td>
	</tr>
</table>

