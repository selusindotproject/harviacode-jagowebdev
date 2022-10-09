<?php

namespace App\Models;

class BarangModel extends \App\Models\BaseModel
{

    public function __construct()
    {
		parent::__construct();
	}

    public function deleteData()
    {
		$result = $this->db->table('barang')->delete(['id_barang' => $_POST['id']]);
		return $result;
	}

    public function getBarangById($id)
    {
		$sql = 'SELECT * FROM barang WHERE id_barang = ?';
		$result = $this->db->query($sql, trim($id))->getRowArray();
		return $result;
	}

    public function saveData()
	{
		$data_db['nama'] = $_POST['nama'];
		$data_db['deskripsi'] = $_POST['deskripsi'];

        $query = false;

		if ($_POST['id']) {
			$data_db['tgl_update'] = date('Y-m-d');
			$data_db['id_user_update'] = $_SESSION['user']['id_user'];
			$query = $this->db->table('barang')->update($data_db, ['id_barang' => $_POST['id']]);
		} else {
			$data_db['tgl_create'] = date('Y-m-d');
			$data_db['id_user_create'] = $_SESSION['user']['id_user'];
			$query = $this->db->table('barang')->insert($data_db);
			$result['id_barang'] = '';
			if ($query) {
				$result['id_barang'] = $this->db->insertID();
			}
		}

		if ($query) {
			$result['status'] = 'ok';
			$result['message'] = 'Data berhasil disimpan';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Data gagal disimpan';
		}

		return $result;
	}

    public function countAllData($where)
    {
		$sql = 'SELECT COUNT(*) AS jml FROM barang' . $where;
		$result = $this->db->query($sql)->getRow();
		return $result->jml;
	}

    public function getListData($where)
    {
		$columns = $this->request->getPost('columns');

		// Search
		$search_all = @$this->request->getPost('search')['value'];
		if ($search_all) {
			// Additional Search
			// $columns[]['data'] = 'tempat_lahir';
			foreach ($columns as $val) {

				if (strpos($val['data'], 'ignore_search') !== false)
					continue;

				if (strpos($val['data'], 'ignore') !== false)
					continue;

				$where_col[] = $val['data'] . ' LIKE "%' . $search_all . '%"';
			}
			$where .= ' AND (' . join(' OR ', $where_col) . ') ';
		}

		// Order
		$order_data = $this->request->getPost('order');
		$order = '';
		if (strpos($_POST['columns'][$order_data[0]['column']]['data'], 'ignore_search') === false) {
			$order_by = $columns[$order_data[0]['column']]['data'] . ' ' . strtoupper($order_data[0]['dir']);
			$order = ' ORDER BY ' . $order_by;
		}

		// Query Total Filtered
		$sql = 'SELECT COUNT(*) AS jml_data FROM barang ' . $where;
		$total_filtered = $this->db->query($sql)->getRowArray()['jml_data'];

		// Query Data
		$start = $this->request->getPost('start') ?: 0;
		$length = $this->request->getPost('length') ?: 10;
		$sql = 'SELECT * FROM barang
				' . $where . $order  . ' LIMIT ' . $start . ', ' . $length;
		$data = $this->db->query($sql)->getResultArray();

		return ['data' => $data, 'total_filtered' => $total_filtered];
	}

}
