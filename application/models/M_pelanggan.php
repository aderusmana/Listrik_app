<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    public function do_pelanggan_login()
    {
        $username    = $this->input->post('username');
        $password    = md5($this->input->post('password'));
        return $this->db->query("SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
    }

    public function do_pelanggan_tampil()
    {
        return $this->db->query("SELECT * FROM pelanggan INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif ORDER BY nama_pelanggan ASC")->result();
    }

    public function do_pelanggan_hitung()
    {
        return $this->db->query("SELECT * FROM pelanggan")->num_rows();
    }

    public function cek_nomormeter()
    {
        $nomor_kwh      = $this->input->post('nomor_kwh');

        return $this->db->query("SELECT * FROM pelanggan WHERE nomor_kwh='$nomor_kwh'")->row();
    }

    public function do_pelanggan_tambah()
    {
        $username       = $this->input->post('username');
        $password       = md5($this->input->post('password'));
        $nomor_kwh      = $this->input->post('nomor_kwh');
        $nama_pelangan  = $this->input->post('nama_pelanggan');
        $alamat         = $this->input->post('alamat');
        $id_tarif       = $this->input->post('id_tarif');

        $this->db->query("INSERT INTO pelanggan VALUES('', '$username', '$password', '$nomor_kwh', '$nama_pelangan', '$alamat', '$id_tarif')");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_datapelanggan_id($id)
    {
        return $this->db->query("SELECT * FROM pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE id_pelanggan='$id'")->row();
    }

    public function do_pelanggan_ubah()
    {
        $id_pelanggan    = $this->input->post('id_pelanggan');
        $username        = $this->input->post('username');
        $nomor_kwh       = $this->input->post('nomor_kwh');
        $nama_pelangan   = $this->input->post('nama_pelanggan');
        $alamat          = $this->input->post('alamat');
        $id_tarif        = $this->input->post('id_tarif');

        return $this->db->query("UPDATE pelanggan SET username='$username', nomor_kwh='$nomor_kwh', nama_pelanggan='$nama_pelangan', alamat='$alamat', id_tarif='$id_tarif' WHERE id_pelanggan='$id_pelanggan'");
    }

    public function do_pelanggan_hapus($id)
    {
        return $this->db->query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    }
}
