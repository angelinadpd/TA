<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Realisasi</title>
    <body>
	
		<div style="font-family:Arial; font-size:12px;">
			<center><div style="font-family:Arial; font-size:12px;">
			<table>
			<tr>
				<td width="40"><img src="vendors/img/bg.jpg" class="bg-image img-responsive"  width="100px" height="100px" ></td>
				<td width="60"><h2>PT. Besar Anugerah Kasih Sejati</h2>   
			        <h5>Jl. Gurun Laweh No. 3G & 3H<br>
			            Telp.0751 841174</h5>
			    </td>
			</tr>
			</table>
			</center>
		</div>

		<h1 align="center">Laporan Realisasi Pemesanan</h1><br>	

<?php
	$i=0
?>		   
	    <table align="center" width="100%">			
		      <tbody>
		      	<tr bgcolor="#e55e5e">
			    <th align="center" colspan="6">Pemesanan</th>
			    <th align="center" colspan="7">Realisasi</th>
			  </tr>
		        <tr bgcolor="#ea8181">
		    		<th align="center">No.</th>
		    		<th align="center">No. SO</th>
		    		<th align="center">Tanggal Pesan</th>
		    		<th align="center">Tipe Barang</th>
		    		<th align="center">Nama Barang</th>
		    		<th align="center">ID Realisasi</th>
		    		<th align="center">No. DO</th>
		    		<th align="center">Tanggal Realisasi</th>
		    		<th align="center">Price</th>
		    		<th align="center">Quantity</th>
		    		<th align="center">Total</th>
		    		<th align="center">Status</th>
		        </tr>
		      
				@foreach($realisasi as $realisasi)
		        <tr bgcolor="#f0c7c7">
		        	<td align="center"> {{$i=$i+1}} </td>
			        <td> SO{{ $realisasi->no_so}} </td>
			        <td> {{ $realisasi->tgl_pesan}} </td>
			        <td  align="center"> {{ $realisasi->tipe_barang}} </td>
			        <td  align="center"> {{ $realisasi->nama_barang}} </td>
			        <td  align="center"> {{ $realisasi->id}} </td>
			        <td> {{ $realisasi->no_do}} </td>
			        <td> {{ $realisasi->tgl_realisasi}} </td>
			        <td> Rp.{{ $realisasi->price}} </td>
			        <td  align="center">{{ $realisasi->qty}} </td>
			        <td> Rp.{{ $realisasi->total}} </td>
			        <td> {{ $realisasi->status}} </td>					 
		        </tr>		
				@endforeach
		      </tbody>		
		    </table>
		   <table style="border-spacing: 0; border-collapse: collapse; width: 100%">
		   	<tr>
		   		<td align="center" width="50%"><br><br><br>Pimpinan<br><br><br><br></td>
		   		<td align="center" width="50%"><br><br><br>Padang, {{date('d-M-Y')}}<br>Admin Pembelian<br><br><br></td>
		   	</tr>
		   	<tr>
		   		<td align="center">Akong</td>
		   		<td align="center">{{ Auth::user()->name }}</td>
		   	</tr>
		</table>
		<br/>
	<br/>
  </body>
</html>