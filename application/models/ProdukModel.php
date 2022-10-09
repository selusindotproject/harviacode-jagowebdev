<?php

namespace App\Models;

class ProdukModel extends \App\Models\BaseModel
{

    public function __construct()
    {
		parent::__construct();
	}

    public function deleteData()
    {
		$result = $this->db->table('produk')->delete(['id_produk' => $_POST['id']]);
		return $result;
	}

    public function getProdukById($id)
    {
		$sql = 'SELECT * FROM produk WHERE id_produk = ?';
		$result = $this->db->query($sql, trim($id))->getRowArray();
		return $result;
	}

    public function saveData()
	{
		$data_db['nama_produk'] = $_POST['nama_produk']
		$data_db['deskripsi_produk'] = $_POST['deskripsi_produk']
		$data_db['id_user_input'] = $_POST['id_user_input']
		$data_db['tgl_input'] = $_POST['tgl_input']

        $query = false;

		if ($_POST['id']) {
			$data_db['tgl_update'] = date('Y-m-d');
			$data_db['id_user_update'] = $_SESSION['user']['id_user'];
			$query = $this->db->table('produk')->update($data_db, ['id_produk' => $_POST['id']]);
		} else {
			$data_db['tgl_create'] = date('Y-m-d');
			$data_db['id_user_create'] = $_SESSION['user']['id_user'];
			$query = $this->db->table('produk')->insert($data_db);
			$result['id_produk'] = '';
			if ($query) {
				$result['id_produk'] = $this->db->insertID();
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
		$sql = 'SELECT COUNT(*) AS jml FROM produk' . $where;
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
		$sql = 'SELECT COUNT(*) AS jml_data FROM produk ' . $where;
		$total_filtered = $this->db->query($sql)->getRowArray()['jml_data'];

		// Query Data
		$start = $this->request->getPost('start') ?: 0;
		$length = $this->request->getPost('length') ?: 10;
		$sql = 'SELECT * FROM produk
				' . $where . $order  . ' LIMIT ' . $start . ', ' . $length;
		$data = $this->db->query($sql)->getResultArray();

		return ['data' => $data, 'total_filtered' => $total_filtered];
	}

}
