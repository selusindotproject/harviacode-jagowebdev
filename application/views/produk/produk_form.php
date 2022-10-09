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
        <h2 style="margin-top:0px">Produk <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Produk <?php echo form_error('nama_produk') ?></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="deskripsi_produk">Deskripsi Produk <?php echo form_error('deskripsi_produk') ?></label>
            <textarea class="form-control" rows="3" name="deskripsi_produk" id="deskripsi_produk" placeholder="Deskripsi Produk"><?php echo $deskripsi_produk; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Id User Input <?php echo form_error('id_user_input') ?></label>
            <input type="text" class="form-control" name="id_user_input" id="id_user_input" placeholder="Id User Input" value="<?php echo $id_user_input; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Input <?php echo form_error('tgl_input') ?></label>
            <input type="text" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tgl Input" value="<?php echo $tgl_input; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id User Update <?php echo form_error('id_user_update') ?></label>
            <input type="text" class="form-control" name="id_user_update" id="id_user_update" placeholder="Id User Update" value="<?php echo $id_user_update; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Update <?php echo form_error('tgl_update') ?></label>
            <input type="text" class="form-control" name="tgl_update" id="tgl_update" placeholder="Tgl Update" value="<?php echo $tgl_update; ?>" />
        </div>
	    <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>