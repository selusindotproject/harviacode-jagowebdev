<form method="post" action="" class="form-horizontal p-3">
	<div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama_produk</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="nama_produk" value="<?=@$nama_produk?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Deskripsi_produk</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="deskripsi_produk" value="<?=@$deskripsi_produk?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Id_user_input</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="id_user_input" value="<?=@$id_user_input?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tgl_input</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="tgl_input" value="<?=@$tgl_input?>" required="required"/>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" value="<?=@$_GET['id']?>"/>
</form>
