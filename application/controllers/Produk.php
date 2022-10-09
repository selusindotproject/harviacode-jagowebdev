<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class Produk extends \App\Controllers\BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProdukModel;
		$this->data['site_title'] = 'Produk';
		$this->addJs($this->config->baseURL.'public/themes/modern/js/image-upload.js');
		$this->addJs($this->config->baseURL.'public/themes/modern/js/form-ajax.js');
		$this->addJs($this->config->baseURL.'public/vendors/flatpickr/dist/flatpickr.js');
		$this->addStyle($this->config->baseURL.'public/vendors/flatpickr/dist/flatpickr.min.css');
    }

    public function index()
    {
        $this->cekHakAkses('read_data');
		$data = $this->data;
		$this->view('produk-list', $data);
    }

    public function ajaxDeleteData()
    {
		$result = $this->model->deleteData();
		if ($result) {
			$esult = ['status' => 'ok', 'message' => 'Data Produk berhasil dihapus'];
		} else {
			$result = ['status' => 'error', 'message' => 'Data Produk gagal dihapus'];
		}
		echo json_encode($result);
	}

    public function add()
	{
		$data = $this->data;
		$data['title'] = 'Tambah Data Produk';
		$data['breadcrumb']['Add'] = '';
		$data['msg'] = [];
		if (isset($_POST['submit'])) {
			$form_errors = false;
			if ($form_errors) {
				$data['msg']['status'] = 'error';
				$data['msg']['content'] = $form_errors;
			} else {
				$message = $this->model->saveData();
				$data = array_merge($data, $message);
				$data['breadcrumb']['Edit'] = '';
				$data_produk = $this->model->getProdukById($message['id_produk']);
				$data = array_merge($data, $data_produk);
			}
		}
	}

    public function ajaxGetFormData()
    {
		$data = [];
		if (isset($_GET['id'])) {
			if ($_GET['id']) {
				$data = $this->model->getProdukById($_GET['id']);
				if (!$data)
					return;
			}
		}
		$data = array_merge($data, $this->data);
		// echo view('themes/modern/produk-form', $data);
        echo view('produk-form', $data);
	}

    public function ajaxUpdateData()
    {
		$message = $this->model->saveData();
		echo json_encode($message);
	}

    public function edit()
	{
		$this->cekHakAkses('update_data', 'produk');
		$this->data['title'] = 'Edit ' . $this->currentModule['judul_module'];
		$data = $this->data;
		if (empty($_GET['id'])) {
			$this->errorDataNotFound();
			return;
		}
		$data['msg'] = [];
		if (isset($_POST['submit'])) {
			$form_errors = false;
			if ($form_errors) {
				$data['msg']['status'] = 'error';
				$data['msg']['content'] = $form_errors;
			} else {
				$message = $this->model->saveData();
				$data = array_merge($data, $message);
			}
		}
		$data['breadcrumb']['Edit'] = '';
		$data_produk = $this->model->getProdukById($_GET['id']);
		if (empty($data_produk)) {
			$this->errorDataNotFound();
			return;
		}
		$data = array_merge($data, $data_produk);
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
                        'data-id' => $val['id_produk']
                        ],
                    'label' => 'Edit'
                    ])
                . btn_label([
                    'icon' => 'fas fa-times',
                    'url' => '#',
                    'attr' => [
                        'class' => 'btn btn-danger btn-delete btn-xs',
                        'data-id' => $val['id_produk'],
                        'data-delete-title' => 'Hapus data Produk'
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
