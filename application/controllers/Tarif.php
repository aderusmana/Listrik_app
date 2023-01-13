<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tarif');
    }

    public function data_tarif()
    {
        $data['konten'] = 'masterdata/v_tarif';
        $data['count'] = $this->M_tarif->do_tarif_hitung();
        $data['tarif'] = $this->M_tarif->do_tarif_tampil();
        $data['active'] = 'Tarif';
        $data['judul'] = 'Tarif';
        $this->load->view('layout/template', $data);
    }

    public function tarif_tambah()
    {
        $this->form_validation->set_rules('daya', 'Daya', 'trim|required|numeric', array('required' => 'Daya harus diisi.'));
        $this->form_validation->set_rules('tarifperkwh', 'Tarif/ Kwh', 'trim|required|numeric', array('required' => 'Tarif/ Kwh harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('tambah')) {
                if ($this->M_tarif->do_tarif_tambah() == TRUE) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah tarif.</div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah tarif.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Tarif/data_tarif');
    }

    public function get_tarif_id($id)
    {
        $data = $this->M_tarif->get_datatarif_id($id);
        echo (json_encode($data));
    }

    public function tarif_ubah()
    {
        $this->form_validation->set_rules('daya', 'Daya', 'trim|required|numeric', array('required' => 'Daya harus diisi.'));
        $this->form_validation->set_rules('tarifperkwh', 'Tarif/ Kwh', 'trim|required|numeric', array('required' => 'Tarif/ Kwh harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('ubah')) {
                if ($this->M_tarif->do_tarif_ubah() == TRUE) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses mengubah tarif.</div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengubah tarif.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Tarif/data_tarif');
    }

    public function tarif_hapus($id = '')
    {
        $hapus = $this->M_tarif->do_tarif_hapus($id);
        if ($hapus == TRUE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menghapus tarif.</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus tarif.</div>');
        }
        redirect('Tarif/data_tarif');
    }
}
