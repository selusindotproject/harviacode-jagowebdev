<?php

$string = "<?php

namespace App\Controllers;
use App\Models\\".$c."Model;

class " . $c . " extends \App\Controllers\BaseController
{

    public function __construct()
    {
        parent::__construct();
        \$this->model = new ".$c."Model;
		\$this->data['site_title'] = '".$c."';
		\$this->addJs(\$this->config->baseURL.'public/themes/modern/js/image-upload.js');
		\$this->addJs(\$this->config->baseURL.'public/themes/modern/js/form-ajax.js');
		\$this->addJs(\$this->config->baseURL.'public/vendors/flatpickr/dist/flatpickr.js');
		\$this->addStyle(\$this->config->baseURL.'public/vendors/flatpickr/dist/flatpickr.min.css');
    }

    public function index()
    {
        \$this->cekHakAkses('read_data');
		\$data = \$this->data;
		\$this->view('".$c_url."-list', \$data);
    }

    public function ajaxDeleteData()
    {
		\$result = \$this->model->deleteData();
		if (\$result) {
			\$result = ['status' => 'ok', 'message' => 'Data ".$c." berhasil dihapus'];
		} else {
			\$result = ['status' => 'error', 'message' => 'Data ".$c." gagal dihapus'];
		}
		echo json_encode(\$result);
	}

    public function add()
	{
		\$data = \$this->data;
		\$data['title'] = 'Tambah Data ".$c."';
		\$data['breadcrumb']['Add'] = '';
		\$data['msg'] = [];
		if (isset(\$_POST['submit'])) {
			\$form_errors = false;
			if (\$form_errors) {
				\$data['msg']['status'] = 'error';
				\$data['msg']['content'] = \$form_errors;
			} else {
				\$message = \$this->model->saveData();
				\$data = array_merge(\$data, \$message);
				\$data['breadcrumb']['Edit'] = '';
				\$data_".$c_url." = \$this->model->get".$c."ById(\$message['".$pk."']);
				\$data = array_merge(\$data, \$data_".$c_url.");
			}
		}
	}

    public function ajaxGetFormData()
    {
		\$data = [];
		if (isset(\$_GET['id'])) {
			if (\$_GET['id']) {
				\$data = \$this->model->get".$c."ById(\$_GET['id']);
				if (!\$data)
					return;
			}
		}
		\$data = array_merge(\$data, \$this->data);
		// echo view('themes/modern/".$c_url."-form', \$data);
        echo view('".$c_url."-form', \$data);
	}

    public function ajaxUpdateData()
    {
		\$message = \$this->model->saveData();
		echo json_encode(\$message);
	}

    public function edit()
	{
		\$this->cekHakAkses('update_data', '".$c_url."');
		\$this->data['title'] = 'Edit ' . \$this->currentModule['judul_module'];
		\$data = \$this->data;
		if (empty(\$_GET['id'])) {
			\$this->errorDataNotFound();
			return;
		}
		\$data['msg'] = [];
		if (isset(\$_POST['submit'])) {
			\$form_errors = false;
			if (\$form_errors) {
				\$data['msg']['status'] = 'error';
				\$data['msg']['content'] = \$form_errors;
			} else {
				\$message = \$this->model->saveData();
				\$data = array_merge(\$data, \$message);
			}
		}
		\$data['breadcrumb']['Edit'] = '';
		\$data_".$c_url." = \$this->model->get".$c."ById(\$_GET['id']);
		if (empty(\$data_".$c_url.")) {
			\$this->errorDataNotFound();
			return;
		}
		\$data = array_merge(\$data, \$data_".$c_url.");
	}

    public function getDataDT()
    {
		\$this->cekHakAkses('read_data');

		\$num_data = \$this->model->countAllData(\$this->whereOwn());
		\$result['draw'] = \$start = \$this->request->getPost('draw') ? : 1;
		\$result['recordsTotal'] = \$num_data;

		\$query = \$this->model->getListData(\$this->whereOwn());
		\$result['recordsFiltered'] = \$query['total_filtered'];

		helper('html');

		\$no = \$this->request->getPost('start') + 1 ? : 1;
		foreach (\$query['data'] as \$key => &\$val) {

			\$val['ignore_search_urut'] = \$no;
			\$val['ignore_search_action'] =
                '<div class=\"form-inline btn-action-group\">'
				. btn_label([
                    'icon' => 'fas fa-edit',
                    'url' => '#',
                    'attr' => [
                        'class' => 'btn btn-success btn-edit btn-xs me-1',
                        'data-id' => \$val['".$pk."']
                        ],
                    'label' => 'Edit'
                    ])
                . btn_label([
                    'icon' => 'fas fa-times',
                    'url' => '#',
                    'attr' => [
                        'class' => 'btn btn-danger btn-delete btn-xs',
                        'data-id' => \$val['".$pk."'],
                        'data-delete-title' => 'Hapus data ".$c."'
                        ],
                    'label' => 'Delete'
                    ])
                . '</div>';
			\$no++;
		}

		\$result['data'] = \$query['data'];
		echo json_encode(\$result); exit();
	}

}
";

$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>
