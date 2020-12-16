<?php

class Perpustakaan_model extends CI_Model
{
    public function getPerpustakaan($id_pengunjung = null) 
    {
        if ($id_pengunjung === null) {
            return $this->db->get('perpustakaan')->result_array();
        } else {
            return $this->db->get_where('perpustakaan', ['id_pengunjung => $id_pengunjung'])->result_array();
        }
        
    }

    public function deletePerpustakaan ($id_pengunjung)
    {
        $this->db->delete('perpustakaan', ['id' => $id_pengunjung]);
        return $this->db->affected_rows();
    }

    public function createPerpustakaan ($data)
    {
        $this->db->insert('perpustakaan', $data);
        return $this->db->affected_rows();
    }

    public function updatePerpustakaan ($data, $id_pengunjung)
    {
        $this->db->update('perpustakaan', $data, ['id_pengunjung' => $id_pengunjung]);
        return $this->db->affected_rows();
    }
} 