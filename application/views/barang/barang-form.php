<form method="post" action="" class="form-horizontal p-3">
	<div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="nama" value="<?=@$nama?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="deskripsi" value="<?=@$deskripsi?>" required="required"/>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" value="<?=@$_GET['id']?>"/>
</form>
