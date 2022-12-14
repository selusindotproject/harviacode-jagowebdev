<?php

namespace App\Controllers;
use App\Models\BarangModel;

class Barang extends \App\Controllers\BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new BarangModel;
		$this->data['site_title'] = 'Barang';
		$this->addJs($this->config->baseURL.'public/themes/modern/js/form-ajax.js');
    }

    public function index()
    {
        $this->cekHakAkses('read_data');
		$data = $this->data;
		$this->view('barang-list', $data);
    }

    public function ajaxDeleteData()
    {
		$result = $this->model->deleteData();
		if ($result) {
			$result = ['status' => 'ok', 'message' => 'Data Barang berhasil dihapus'];
		} else {
			$result = ['status' => 'error', 'message' => 'Data Barang gagal dihapus'];
		}
		echo json_encode($result);
	}

    public function ajaxGetFormData()
    {
		$data = [];
		if (isset($_GET['id'])) {
			if ($_GET['id']) {
				$data = $this->model->getBarangById($_GET['id']);
				if (!$data)
					return;
			}
		}
		$data = array_merge($data, $this->data);
		echo view('themes/modern/barang-form', $data);
	}

    public function ajaxUpdateData()
    {
		$message = $this->model->saveData();
		echo json_encode($message);
	}

    public function getDataDT()
    {
		$this->cekHakAkses('read_data');

		$num_data = $this->model->countAllData($this->whereOwn());
		$result['draw'] = $start = $this->request->getPost('draw') ? : 1;
		$result['recordsTotal'] = $num_data;

		$query = $this->model->getListData($this->whereOwn());
		$result['recordsFiltered'] = $query['total_filtered'];

		helper('html');

		$no = $this->request->getPost('start') + 1 ? : 1;
		foreach ($query['data'] as $key => &$val) {

			$val['ignore_search_urut'] = $no;
			$val['ignore_search_action'] =
                '<div class="form-inline btn-action-group">'
				. btn_label([
                    'icon' => 'fas fa-edit',
                    'url' => '#',
                    'attr' => [
                        'class' => 'btn btn-success btn-edit btn-xs me-1',
                        'data-id' => $val['id_barang']
                        ],
                    'label' => 'Edit'
                    ])
                . btn_label([
                    'icon' => 'fas fa-times',
                    'url' => '#',
                    'attr' => [
                        'class' => 'btn btn-danger btn-delete btn-xs',
                        'data-id' => $val['id_barang'],
                        'data-delete-title' => 'Hapus data Barang No. : ' . $no
                        ],
                    'label' => 'Delete'
                    ])
                . '</div>';
			$no++;
		}

		$result['data'] = $query['data'];
		echo json_encode($result); exit();
	}

}
