<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Penjualan</title>
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
		<h1 align="center">Laporan Penjualan</h1><br><br>						   
	    <table align="center" width="100%">
			<thead>
		        <tr bgcolor="#ea8181">
		    		<th align="center">ID Penjualan</th>
		    		<th align="center">Nota</th>
		    		<th align="center">Tanggal</th>
		    		<th align="center">Nama Pembeli</th>
		    		<th align="center">ID Barang</th>
		    		<th align="center">Quantity</th>
		    		<th align="center">Price</th>
		    		<th align="center">Amount</th>
		    		<th align="center">DPP</th>
		    		<th align="center">PPN</th>
		        </tr>
		      </thead>
		      <tbody>
				@foreach($penjualan as $penjualan)
		        <tr bgcolor="#f0c7c7">
		        	<td align="center"> {{ $penjualan->id}} </td>
			        <td> {{ $penjualan->nota}} </td>
			        <td> {{ $penjualan->tgl}} </td>
			        <td> {{ $penjualan->nama_pembeli}} </td>
			        <td  align="center"> {{ $penjualan->barang_id}} </td>
			        <td  align="center"> {{ $penjualan->qty}} </td>
			        <td> RP.{{ $penjualan->price}} </td>
			        <td> Rp.{{ $penjualan->amount}} </td>
			        <td> Rp.{{ $penjualan->dpp}} </td>
			        <td  align="center"> Rp.{{ $penjualan->ppn}} </td>				 
		        </tr>		
				@endforeach
				<tr bgcolor="#f0c7c7" >
		        	<th align="center" colspan="6"> Total</th>
			        <th> Rp.{{ $tprice}} </th>
			        <th> Rp.{{ $tamount}} </th>
			        <th> Rp.{{ $tdpp}}</th>
			        <th  align="center"> Rp.{{ $tppn}}</th>				 
		        </tr>
		      </tbody>		
		    </table>
		   <table style="border-spacing: 0; border-collapse: collapse; width: 100%">
		   	<tr>
		   		<td align="center" width="50%"><br><br><br>Pimpinan<br><br><br><br></td>
		   		<td align="center" width="50%"><br><br><br>Padang, {{date('d-M-Y')}}<br>Admin Penjualan<br><br><br></td>
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