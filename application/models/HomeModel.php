<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {
 
    public function get_identitas($id = null) {
        if($id != null) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('created_at', 'asc');
        $query = $this->db->get('identitas');
        return $query;
    }

    public function insert_identitas($insert) {
        $data = [
            'nama'          => $insert['nama'],
            'jenis_kelamin' => $insert['jenis_kelamin'],
            'tanggal_lahir' => $insert['tanggal_lahir'],
            'alamat'        => $insert['alamat'],
            'foto'          => $insert['foto'],
            'created_at'    => date('Y-m-d'),
            'updated_at'    => date('Y-m-d')
        ];

        $this->db->insert('identitas', $data);
    }

    public function update_identitas($update) {
        $data = [
            'nama'          => $update['nama'],
            'jenis_kelamin' => $update['jenis_kelamin'],
            'tanggal_lahir' => $update['tanggal_lahir'],
            'alamat'        => $update['alamat'],
            'updated_at'    => date('Y-m-d')
        ];

        if ($update['foto'] != null) {
			$data['foto'] = $update['foto'];
		}

        $this->db->where('id', $update['id']);
        $this->db->update('identitas', $data);
    }

    public function delete_identitas($id) {
        $this->db->where('id', $id);
        $this->db->delete('identitas');
    }
}