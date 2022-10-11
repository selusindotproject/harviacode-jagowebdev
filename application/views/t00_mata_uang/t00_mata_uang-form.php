<form method="post" action="" class="form-horizontal p-3">
	<div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="nama" value="<?=@$nama?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kode</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="kode" value="<?=@$kode?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Simbol</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="simbol" value="<?=@$simbol?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Negara</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="negara" value="<?=@$negara?>" required="required"/>
			</div>
		</div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Aktif</label>
            <div class="col-sm-9">
				<input class="form-control" type="text" name="aktif" value="<?=@$aktif?>" required="required"/>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" value="<?=@$_GET['id']?>"/>
</form>
