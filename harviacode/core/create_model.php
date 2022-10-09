<?php

$string = "<?php

namespace App\Models;

class ".$m." extends \App\Models\BaseModel
{

    public function __construct()
    {
		parent::__construct();
	}

    public function deleteData()
    {
		\$result = \$this->db->table('".$table_name."')->delete(['".$pk."' => \$_POST['id']]);
		return \$result;
	}

    public function get".$c."ById(\$id)
    {
		\$sql = 'SELECT * FROM ".$table_name." WHERE ".$pk." = ?';
		\$result = \$this->db->query(\$sql, trim(\$id))->getRowArray();
		return \$result;
	}

    public function saveData()
	{";
        foreach ($non_pk as $row) {
            if ($row['column_name'] == 'tgl_create'
            or $row['column_name'] == 'id_user_create'
            or $row['column_name'] == 'tgl_update'
            or $row['column_name'] == 'id_user_update') {
            } else {
                $string .= "\n\t\t\$data_db['".$row['column_name']."'] = \$_POST['".$row['column_name']."'];";
            }
        }
        $string .= "

        \$query = false;

		if (\$_POST['id']) {
			\$data_db['tgl_update'] = date('Y-m-d');
			\$data_db['id_user_update'] = \$_SESSION['user']['id_user'];
			\$query = \$this->db->table('".$table_name."')->update(\$data_db, ['".$pk."' => \$_POST['id']]);
		} else {
			\$data_db['tgl_create'] = date('Y-m-d');
			\$data_db['id_user_create'] = \$_SESSION['user']['id_user'];
			\$query = \$this->db->table('".$table_name."')->insert(\$data_db);
			\$result['".$pk."'] = '';
			if (\$query) {
				\$result['".$pk."'] = \$this->db->insertID();
			}
		}

		if (\$query) {
			\$result['status'] = 'ok';
			\$result['message'] = 'Data berhasil disimpan';
		} else {
			\$result['status'] = 'error';
			\$result['message'] = 'Data gagal disimpan';
		}

		return \$result;
	}

    public function countAllData(\$where)
    {
		\$sql = 'SELECT COUNT(*) AS jml FROM ".$table_name."' . \$where;
		\$result = \$this->db->query(\$sql)->getRow();
		return \$result->jml;
	}

    public function getListData(\$where)
    {
		\$columns = \$this->request->getPost('columns');

		// Search
		\$search_all = @\$this->request->getPost('search')['value'];
		if (\$search_all) {
			// Additional Search
			// \$columns[]['data'] = 'tempat_lahir';
			foreach (\$columns as \$val) {

				if (strpos(\$val['data'], 'ignore_search') !== false)
					continue;

				if (strpos(\$val['data'], 'ignore') !== false)
					continue;

				\$where_col[] = \$val['data'] . ' LIKE \"%' . \$search_all . '%\"';
			}
			\$where .= ' AND (' . join(' OR ', \$where_col) . ') ';
		}

		// Order
		\$order_data = \$this->request->getPost('order');
		\$order = '';
		if (strpos(\$_POST['columns'][\$order_data[0]['column']]['data'], 'ignore_search') === false) {
			\$order_by = \$columns[\$order_data[0]['column']]['data'] . ' ' . strtoupper(\$order_data[0]['dir']);
			\$order = ' ORDER BY ' . \$order_by;
		}

		// Query Total Filtered
		\$sql = 'SELECT COUNT(*) AS jml_data FROM ".$table_name." ' . \$where;
		\$total_filtered = \$this->db->query(\$sql)->getRowArray()['jml_data'];

		// Query Data
		\$start = \$this->request->getPost('start') ?: 0;
		\$length = \$this->request->getPost('length') ?: 10;
		\$sql = 'SELECT * FROM ".$table_name."
				' . \$where . \$order  . ' LIMIT ' . \$start . ', ' . \$length;
		\$data = \$this->db->query(\$sql)->getResultArray();

		return ['data' => \$data, 'total_filtered' => \$total_filtered];
	}

}
";

$hasil_model = createFile($string, $target."models/" . $m_file);

?>
