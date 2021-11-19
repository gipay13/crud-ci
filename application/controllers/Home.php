<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('HomeModel');
	}
	
	public function index() { 
		$data = [
			'identitas' => $this->HomeModel->get_identitas()->result()
		];

		$this->load->view('home-page', $data);
	}

	public function form() {
		$i = new stdClass();
		$i->id = null;
		$i->nama = null;
		$i->jenis_kelamin = null;
		$i->tanggal_lahir = null;
		$i->alamat = null;
		$i->foto = null;

		$data = [
			'submit'	=> 'insert',
			'i'			=> $i
		];

		$this->load->view('form-page', $data);
	}

	public function process() {
		$process = $this->input->post(null, TRUE);

		// print_r($process);
		$config = [
			'upload_path' 	=> './uploads',
			'allowed_types'	=> 'jpeg|jpg|png',
			'max_size'		=> 2048,
			'file_name'		=> 'item-'.date('ymd').'-'.substr(md5(rand()), 0, 10)
		];
		$this->load->library('upload', $config);

		if(isset($_POST['insert'])) {
			if(@$_FILES['foto']['name'] != null) {
				if($this->upload->do_upload('foto')) {
					$process['foto'] = $this->upload->data('file_name');

					$this->HomeModel->insert_identitas($process);

					if($this->db->affected_rows() > 0) {
						$this->session->set_flashdata(
							'message',
							'<div class="alert alert-success alert-dismissible">
								<button type="button" class="btn-close" aria-label="Close"></button>
								<span>Input Identitas Sucess</span>
							</div>'
						);
						redirect('home');
					}
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" aria-label="Close"></button>
							<span>'.$error.'</span>
						</div>'
					);
					redirect('home');
				}
			} else {
				$process['foto'] = null;

				$this->HomeModel->insert_identitas($process);

				if($this->db->affected_rows() > 0) {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<span>Input Identitas Sucess</span>
						</div>'
					);	
					redirect('home');
					}
			}
		} else if(isset($_POST['edit'])) {
			if(@$_FILES['foto']['name'] != null) {
				if($this->upload->do_upload('foto')) {
					$foto = $this->HomeModel->get_identitas($process['id'])->row();
					if($foto->foto != null) {
						$target_foto = './uploads/'.$foto->foto;
						unlink($target_foto);
					}
					
					$process['foto'] = $this->upload->data('file_name');

					$this->HomeModel->update_identitas($process);

					if($this->db->affected_rows() > 0) {
						$this->session->set_flashdata(
							'message',
							'<div class="alert alert-success alert-dismissible">
								<button type="button" class="btn-close" aria-label="Close"></button>
								<span>Edit Identitas Sucess</span>
							</div>'
						);
						redirect('home');
					}
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" aria-label="Close"></button>
							<span>'.$error.'</span>
						</div>'
					);
					redirect('home');
				}
			} else {
				$process['foto'] = null;

				$this->HomeModel->update_identitas($process);

				if($this->db->affected_rows() > 0) {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-success alert-dismissible">
							<button type="button" class="btn-close" aria-label="Close"></button>
							<span>Edit Identitas Sucess</span>
						</div>'
					);	
					redirect('home');
					}
			}	
		}
	}

	public function edit($id) {
		$query = $this->HomeModel->get_identitas($id);

		if($query->result() > 0) {
			$i = $query->row();
			$data = [
				'submit' 	=> 'edit',
				'i'	 		=> $i,
			];

			$this->load->view('form-page', $data);
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<span>Data Tidak Ditemukan</span>
				</div>'
			);
			redirect('item');	
		}
	}

	public function delete($id) {
		$foto = $this->HomeModel->get_identitas($id)->row();
		if($foto->foto != null) {
			$target_foto = './uploads/'.$foto->foto;
			unlink($target_foto);
		}

		$this->HomeModel->delete_identitas($id);

		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn-close" aria-label="Close"></button>
					<span>Identitas Dihapus</span>
				</div>'
			);
			redirect('home');
		}
	}
}
