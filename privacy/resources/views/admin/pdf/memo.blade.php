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
            text-align: left;
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
        <h1>Memo-{{$memo->no_memo}}</h1>
       
        <p><b>Jumlah Item:{{$jumlah}}</b></p>
    </div>
  <hr>
	<table rules="rows" class="grid" style="font-size: 10pt; vertical-align: top; width: 27cm" border="1">
			 <thead>
                <tr>
                    <th>No Transaksi</th>
                    <th>Produk</th>
                    <th>Satuan</th>
                    <th>QTY</th>
                 </tr>
            </thead>
            @foreach ($memodetail as $rows)
                  <tr>
                    <td>{{$rows->no_memo}}</td>
                    <td>{{$rows->produk->nama_produk}}</td>
                    <td>{{$rows->satuan->nama_satuan}}</td>
                    <td>{{$rows->qty}}</td>
                  </tr>
            @endforeach
	</table>
<hr>
</body>
</html>