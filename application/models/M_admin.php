<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function do_admin_login()
    {
        $username    = $this->input->post('username');
        $password    = md5($this->input->post('password'));
        return $this->db->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    }

    public function do_level_tampil()
    {
        return $this->db->query("SELECT * FROM level")->result();
    }

    public function do_admin_tampil()
    {
        return $this->db->query("SELECT * FROM admin INNER JOIN level ON admin.id_level=level.id_level")->result();
    }

    public function do_admin_hitung()
    {
        return $this->db->query("SELECT * FROM admin")->num_rows();
    }

    public function do_admin_tambah()
    {
        $username   = $this->input->post('username');
        $password   = md5($this->input->post('password'));
        $nama_admin = $this->input->post('nama_admin');
        $id_level   = $this->input->post('id_level');

        $this->db->query("INSERT INTO admin VALUES('', '$username', '$password', '$nama_admin', '$id_level')");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_dataadmin_id($id)
    {
        return $this->db->query("SELECT * FROM admin
                                INNER JOIN level ON admin.id_level=level.id_level
                                WHERE id_admin='$id'")->row();
    }

    public function do_admin_ubah()
    {
        $id_admin        = $this->input->post('id_admin');
        $username        = $this->input->post('username');
        $nama_admin      = $this->input->post('nama_admin');
        $id_level        = $this->input->post('id_level');

        return $this->db->query("UPDATE admin SET username='$username', nama_admin='$nama_admin', id_level='$id_level' WHERE id_admin='$id_admin'");
    }

    public function do_admin_hapus($id)
    {
        return $this->db->query("DELETE FROM admin WHERE id_admin='$id'");
    }
}
