<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>export pdf</title>

	<style> 
        
     @page {
            border: solid 1px #0b93d5;

        }

        .title {
            margin-top: 0.5cm;
        }
        .title h1 {
            text-align: center;
            font-size: 14pt;
            
        }
        

        .header {
            margin-left: 50px;
            margin-right: 0px;
            /*font-size: 10pt;*/
            padding-top: 10px;
            /*border: solid 1px #0b93d5;*/
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .clearfix {
            overflow: auto;
        }

        .content {
                margin-left: 10px;
            padding-top: 10px
        }
        .catatan {
            font-size: 10pt;
        }

        footer {
                position: fixed; 
                top: 19cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }

        /* Table desain*/
        table.grid {
            width: 100%;
        }
</style>
</head>
<body>

    <div class="title">
       <h1>Transaksi Timbangan</h1>
       <div class="a" align="center">Periode {{$start_date}}  s/d {{$end_date}}</div>
       <p><b>Jumlah Data:{{$jumlah}}</b></p>
    </div>
  <hr>
	<table rules="rows" class="grid" style="font-size: 10pt; vertical-align: top; width: 27cm" border="1">
			 <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>No PO/DO</th>
                    <th>No Polisi</th>
                    <th>No Seal</th>
                    <th>No Container</th>
                    <th>Size Tipe</th>
                    <th>Muatan</th>
                    <th>Nama Supir</th>
                    <th>Barang</th>
                    <th>Supplier</th>
                    <th>Customer</th>
                    <th>Company</th>
                    <th>Berat1</th>
                    <th>Berat2</th>
                    <th>Keterangan</th>
                    <th>Tanggal Masuk</th>
                 </tr>
            </thead>
            @foreach ($transaksi as $transaksi)
                  <tr>
                    <td>{{$transaksi->no_transaksi}}</td>
                    <td>{{$transaksi->no_po}}</td>
                    <td>{{$transaksi->no_polisi}}</td>
                    <td>{{$transaksi->no_seal}}</td>
                    <td>{{$transaksi->no_container}}</td>
                    <td>{{$transaksi->sizetipemaster->size_tipe}}</td>
                    <td>{{$transaksi->muatan}}</td>
                    <td>{{$transaksi->nama_supir}}</td>
                    <td>{{$transaksi->barang->nama_barang}}</td>
                    <td>{{$transaksi->supplier->nama_supplier}}</td>
                    <td>{{$transaksi->customer->nama_customer}}</td>
                    <td>{{$transaksi->company->nama_company}}</td>
                    <td>{{$transaksi->berat1}}</td>
                    <td>{{$transaksi->berat2}}</td>
                    <td>{{$transaksi->keterangan}}</td>
                    <td>{{$transaksi->tanggal_masuk}}</td>
                  </tr>
            @endforeach
	</table>
<hr>
</body>
</html>