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
        <h2 style="margin-top:0px">Barang Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Id User Create</td><td><?php echo $id_user_create; ?></td></tr>
	    <tr><td>Tgl Create</td><td><?php echo $tgl_create; ?></td></tr>
	    <tr><td>Id User Update</td><td><?php echo $id_user_update; ?></td></tr>
	    <tr><td>Tgl Update</td><td><?php echo $tgl_update; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>