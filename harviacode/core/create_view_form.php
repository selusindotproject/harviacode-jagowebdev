<?php

$string2 =
"<form method=\"post\" action=\"\" class=\"form-horizontal p-3\">
	<div>";

    foreach ($non_pk as $row) {
		if ($row['column_name'] == 'tgl_create'
        or $row['column_name'] == 'id_user_create'
        or $row['column_name'] == 'tgl_update'
        or $row['column_name'] == 'id_user_update') {
        } else {
        $string2 .= "
        <div class=\"row mb-3\">
            <label class=\"col-sm-3 col-form-label\">".ucfirst($row['column_name'])."</label>
            <div class=\"col-sm-9\">
				<input class=\"form-control\" type=\"text\" name=\"".$row['column_name']."\" value=\"<?=@\$".$row['column_name']."?>\" required=\"required\"/>
			</div>
		</div>";
        }
    }

    $string2 .= "
	</div>
	<input type=\"hidden\" name=\"id\" value=\"<?=@\$_GET['id']?>\"/>
</form>
";

$string = "<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel=\"stylesheet\" href=\"<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>\"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style=\"margin-top:0px\">".ucfirst($table_name)." <?php echo \$button ?></h2>
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</form>
    </body>
</html>";

$hasil_view_form = createFile($string2, $target."views/" . $c_url . "/" . $v_form_file);

?>
