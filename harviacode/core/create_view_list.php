<?php

$string2 =
"<div class=\"card\">
	<div class=\"card-header\">
		<h5 class=\"card-title\"><?=\$current_module['judul_module']?></h5>
	</div>

	<div class=\"card-body\">
		<a href=\"<?=current_url()?>/add\" class=\"btn btn-success btn-xs btn-add\"><i class=\"fa fa-plus pe-1\"></i> Tambah Data</a>
		<hr/>
		<?php
		if (!empty(\$msg)) {
			show_alert(\$msg);
		}

        \$column['ignore_search_urut'] = 'No';";
        foreach($non_pk as $row) {
			if ($row['column_name'] == 'tgl_create'
            or $row['column_name'] == 'id_user_create'
            or $row['column_name'] == 'tgl_update'
            or $row['column_name'] == 'id_user_update') {
            } else {
                $string2 .= "\n\t\t\$column['".$row['column_name']."'] = '".ucfirst($row['column_name'])."';";
            }
        }
        $string2 .= "
        \$column['ignore_search_action'] = 'Action';

		\$settings['order'] = [1,'asc'];
		\$index = 0;
		\$th = '';
		foreach (\$column as \$key => \$val) {
			\$th .= '<th>' . \$val . '</th>';
			if (strpos(\$key, 'ignore_search') !== false) {
				\$settings['columnDefs'][] = [\"targets\" => \$index, \"orderable\" => false];
			}
			\$index++;
		}

		?>

		<table id=\"table-result\" class=\"table display table-striped table-bordered table-hover\" style=\"width:100%\">
		<thead>
			<tr>
				<?=\$th?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?=\$th?>
			</tr>
		</tfoot>
		</table>
		<?php
			foreach (\$column as \$key => \$val) {
				\$column_dt[] = ['data' => \$key];
			}
		?>
		<span id=\"dataTables-column\" style=\"display:none\"><?=json_encode(\$column_dt)?></span>
		<span id=\"dataTables-setting\" style=\"display:none\"><?=json_encode(\$settings)?></span>
		<span id=\"dataTables-url\" style=\"display:none\"><?=current_url() . '/getDataDT'?></span>
	</div>
</div>
";

$hasil_view_list = createFile($string2, $target."views/" . $c_url . "/" . $v_list_file);

?>
