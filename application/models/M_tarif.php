<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tarif extends CI_Model{
    public function do_tarif_tampil()
    {
        return $this->db->query("SELECT * FROM tarif ORDER BY id_tarif ASC")->result();
    }

    public function do_tarif_hitung()
    {
        return $this->db->query("SELECT * FROM tarif")->num_rows();
    }

    public function do_tarif_tambah()
    {
        $daya        = $this->input->post('daya');
        $tarifperkwh = $this->input->post('tarifperkwh');

        $this->db->query("INSERT INTO tarif VALUES('', '$daya', '$tarifperkwh')");
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function get_datatarif_id($id)
    {
        return $this->db->query("SELECT * FROM tarif WHERE id_tarif='$id'")->row();
    }

    public function do_tarif_ubah()
    {
        $id_tarif        = $this->input->post('id_tarif');
        $daya            = $this->input->post('daya');
        $tarifperkwh     = $this->input->post('tarifperkwh');

        return $this->db->query("UPDATE tarif SET daya='$daya', tarifperkwh='$tarifperkwh' WHERE id_tarif='$id_tarif'");
    }

    public function do_tarif_hapus($id)
    {
        return $this->db->query("DELETE FROM tarif WHERE id_tarif='$id'");
    }
}
