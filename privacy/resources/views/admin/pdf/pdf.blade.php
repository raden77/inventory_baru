<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>export pdf</title>

	<style>
        @page {
            border: solid 1px #0b93d5;
            margin-top: 4px;
            margin-left: 4px;
            margin-right: 4px;
            font-family: 'Courier';
        }

        body { 
           
             
        }

        .title {
            margin-top: 0.5cm;
        }
        .title h1 {
            text-align: left;
            font-size: 20pt;
            
        }

        .span p {
           text-align: right;
           display: block;
           font-size: 8pt;
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

        .footer {
            width: 100%;
            margin-top: 0px;
            margin-bottom: 2px;
            font-size: 8pt;

        }

        /* Table desain*/
        table.grid {
            width: 100%;
            margin-top: 0px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        #color{
            
        }

    </style>
</head>
<body>
<table class="grid">
    <tr>
        <td><img src="{{ asset('css/logo_gui.png') }}" alt="" height="50px" width="50px"></td>
        <td>
            <p id="color" style="font-size: 8pt;"><b>PT.GEMILANG UNGGUL INTERNASIONAL CONTAINER DEPO</b></p>
            <p style="font-size: 7pt;">
            <b> Jln.Slamet Riadi Lr.Lawang Kidul Laut No 1977 Rt.021 <br>
            Kel.Lawang Kidul Kec.Ilir Timur II Palembang <br>
            N.P.W.P: 03.103.981.1-301.000</b>
            </p>
        </td>
    </tr>
</table>
<hr>

<div class="span"> <p><b>No Transaksi {{$transaksi->no_transaksi}}</b></p></div>

	<table  class="grid" style="font-size: 10pt; vertical-align: top; width="100%">
		<tbody>
			 	    <tr >
                        <th width="100px">Tanggal Masuk</th>
                        <td width="1">:</td>
                        <td><b>{{$transaksi->tanggal_masuk}}</b></td>
                    </tr>
                    <tr>
                        <th>Muatan</th>
                        <td>:</td>
                        <td><b>{{$transaksi->muatan}}</b></td>
                    </tr>
                    <tr>
                        <th>No PO/DO</th>
                        <td>:</td>
                        <td><b>{{$transaksi->no_po}}</b></td>
                    </tr>
                    <tr>
                        <th>No Polisi</th>
                        <td>:</td>
                        <td><b>{{$transaksi->no_polisi}}</b></td>
                    </tr>
                    <tr>
                        <th>No Seal</th>
                        <td>:</td>
                        <td><b>{{$transaksi->no_seal}}</b></td>
                    </tr>
                    <tr>
                        <th>No Container</th>
                        <td>:</td>
                        <td><b>{{$transaksi->no_container}}</b></td>
                    </tr>
                    <tr>
                        <th>Size Type</th>
                        <td>:</td>
                        <td><b>{{$transaksi->sizetipemaster->size_type}}</b></td>
                    </tr>
                   
                   {{--  <tr>
                        <th>Nama Supir</th>
                        <td>{{$transaksi->nama_supir}}</td>
                    </tr> --}}
                    {{-- <tr>
                        <th>Nama Barang</th>
                        <td>{{$transaksi->barang->nama_barang}}</td>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{$transaksi->supplier->nama_supplier}}</td>
                    </tr>
                    <tr>
                        <th>Nama Customer</th>
                        <td>{{$transaksi->customer->nama_customer}}</td>
                    </tr>
                    <tr>
                        <th>Nama Company</th>
                        <td>{{$transaksi->company->nama_company}}</td>
                    </tr> --}}
                    <tr>
                        <th>Gross</th>
                        <td>:</td>
                        <td align="right"><b> {{$transaksi->berat1}} Kg </b></td>
                    </tr>
                    <tr>
                        <th>Tare</th>
                        <td>:</td>
                        <td align="right"><b> {{$transaksi->berat2}} Kg </b></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td></td>
                        <td><hr></td> 
                    </tr>
                    <tr>
                        <th>Netto</th>
                        <td>:</td>
                        <td align="right"><b>{{$total}} Kg</b></td>
                    </tr>
                    
		</tbody>
	</table>
<table class="footer">
    <tr>
        <td align="center">
            <p>
            <b>
                Supir
                <br>
                <br>
                <br>
                <br>
            (..........)
            </b>
            </p>
        </td>
        <td align="center">
             <p>
             <b>
               Operator
                <br>
                <br>
                <br>
                <br>
            (..........)
            </b>
             </p>
        </td>
    </tr>
</table>

</body>
</html>