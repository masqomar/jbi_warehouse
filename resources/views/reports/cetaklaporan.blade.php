<h3>
    <center>Laporan Data Santri</center>
</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>#ID</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Beli</th>
        <th>Saldo Awal</th>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>Saldo Akhir</th>
        <th>Total</th>
        <th>Biaya Barcet</th>
    </tr>
    @foreach($laporan as $s)
    <tr>
        <td>{{$s->id}}</td>
        <td>{{$s->name}}</td>
        <td>{{$s->unit->name}}</td>
        <td>{{$s->price}}</td>
        <td>{{$s->first_stock}}</td>
        <td>{{$s->first_stock}}</td>
        <td>{{$s->first_stock}}</td>
        <td>{{$s->first_stock}}</td>
        <td>{{$s->first_stock}}</td>
        <td>{{$s->first_stock}}</td>
    </tr>
    @endforeach
</table>