<!DOCTYPE html>
<html>
   <head>
      <title>Data Penjualan</title>
      <style>
         body {
         width:100% !important;
         margin:0 !important;
         padding:0 !important;
         line-height: 1.45;
         font-family: Garamond,"Times New Roman", serif;
         color: #000;
         background: none;
         font-size: 14pt; }
         /* Headings */
         h1,h2,h3,h4,h5,h6 { page-break-after:avoid; }
         h1{font-size:19pt;}
         h2{font-size:17pt;}
         h3{font-size:15pt;}
         h4,h5,h6{font-size:14pt;}
         p, h2, h3 { orphans: 3; widows: 3; }
         code { font: 12pt Courier, monospace; }
         blockquote { margin: 1.2em; padding: 1em; font-size: 12pt; }
         hr { background-color: #ccc; }
         img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
         a img { border: none; }
         a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;col\
         or:#333; }
         a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ")\
         "; font-size: 90%; }
         abbr[title]:after { content: " (" attr(title) ")"; }
         a[href^="http://"] {color:#000; }
         a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after {\
         content: " (" attr(href) ") "; display:none; }
         a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}
         table { margin: 1px; text-align:left; border: 2;}
         th { border-bottom: 1px solid #333; font-weight: bold; }
         td { border-bottom: 1px solid #333; }
         th,td { padding: 4px 10px 4px 0; }
         tfoot { font-style: italic; }
         caption { background: #fff; margin-bottom:2em; text-align:left; }
         thead {display: table-header-group;}
         img,tr {page-break-inside: avoid;}
      </style>
   </head>
   <body>
      <h1>Data Penjualan</h1>
      <hr>
      <table>
         <thead>
            <tr>
               <td>Kode Penjualan</td>
               <td>Tanggal Jual</td>&nbsp;&nbsp;&nbsp;
               <td>Nama Pelanggan</td>
               <td>Nama Barang</td>
               <td>Merk Barang</td>
               <td>Kategori Barang</td>
               <td>Jumlah Barang</td>
               <td>Total Bayar</td>
            </tr>
         </thead>
         <tbody>
            @foreach ($shop as $book)
            <tr>
               <td>{{ $book->kode_penjualan }}</td>
               <td>{{ $book->tgl_jual }}</td>
               <td>{{ $book->nama_pelanggan }}</td>
               <td>{{ $book->sub->nama_kategori }}</td>
               <td>{{ $book->Barang1->merk }}</td>
               <td>{{ $book->barangkategori->nama_kategori }}</td>
               <td>{{ $book->jumlah }}</td>
               <td>RP.{{number_format($book->total_bayar,2,',','.')}}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </body>
</html>