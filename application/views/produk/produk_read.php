<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Produk Read</h2>
        <table class="table">
	    <tr><td>Nama Produk</td><td><?php echo $nama_produk; ?></td></tr>
	    <tr><td>Deskripsi Produk</td><td><?php echo $deskripsi_produk; ?></td></tr>
	    <tr><td>Id User Input</td><td><?php echo $id_user_input; ?></td></tr>
	    <tr><td>Tgl Input</td><td><?php echo $tgl_input; ?></td></tr>
	    <tr><td>Id User Update</td><td><?php echo $id_user_update; ?></td></tr>
	    <tr><td>Tgl Update</td><td><?php echo $tgl_update; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>