<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Stok Barang</title>
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
<?php
	$i=0
?>		
		<h1 align="center">Laporan Stok Barang</h1><br><br>	
	    <table align="center" width="100%">
			<thead>
		        <tr bgcolor="#ea8181"> 
		          	<th align="center">No.</th>
		    		<th align="center">Tipe Barang</th>
		    		<th align="center">Nama Barang</th>
		    		<th align="center">Price</th>
		    		<th align="center">DPP</th>
		    		<th align="center">PPN</th>
		    		<th align="center">Stok Barang</th>
		        </tr>
		      </thead>
		      <tbody>
				@foreach($barang as $barang)
		        <tr bgcolor="#f0c7c7">
		        	<td align="center"> {{$i=$i+1}} </td>
			        <td> {{ $barang->tipe_barang}} </td>
			        <td> {{ $barang->nama_barang}} </td>
			        <td> Rp.{{ $barang->price}} </td>
			        <td> Rp.{{ $barang->dpp}} </td>
			        <td> Rp.{{ $barang->ppn}} </td>
			        <td align="center"> {{ $barang->stok}} </td>					 
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