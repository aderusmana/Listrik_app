<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function do_penggunaan_hitung()
    {
        return $this->db->query("SELECT * FROM penggunaan")->num_rows();
    }
}
