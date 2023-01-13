<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->model('M_pelanggan');
        $this->load->model('M_tarif');
    }

    public function penggunaan_pelanggan()
    {
        $data['konten'] = 'transaksi/v_penggunaanpelanggan';
        $data['count'] = $this->M_pelanggan->do_pelanggan_hitung();
        $data['pelanggan'] = $this->M_pelanggan->do_pelanggan_tampil();
        $data['tarif'] = $this->M_tarif->do_tarif_tampil();
        $data['active'] = 'Penggunaan';
        $data['judul'] = 'Penggunaan Pelanggan';
        $this->load->view('layout/template', $data);
    }

    public function penggunaan_tambah()
    {
        $this->form_validation->set_rules('id_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi.'));
        $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required', array('required' => 'Bulan harus diisi.'));
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required', array('required' => 'Tahun harus diisi.'));
        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'trim|required|numeric', array('required' => 'Meter Awal harus diisi.'));
        $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'trim|required|numeric', array('required' => 'Meter Akhir harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('tambah')) {
                $cek = $this->M_transaksi->do_cek_penggunaan();
                if ($cek == null) {
                    if ($this->M_transaksi->do_penggunaan_tambah() == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah penggunaan.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah penggunaan.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data sudah ada.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Transaksi/penggunaan_pelanggan');
    }

    public function penggunaan_detail($id = '')
    {
        $data['konten'] = 'transaksi/v_penggunaandetail';
        $data['active'] = 'Penggunaan';
        $data['judul'] = 'Detail Penggunaan';
        $data['detail'] = $this->M_transaksi->do_penggunaan_detail($id);
        $data['count'] = $this->M_transaksi->do_penggunaan_detail_hitung($id);
        $this->load->view('layout/template', $data);
    }

    public function upload_bukti($id)
    {
        $config['upload_path'] = './assets/bukti/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = 'bukti' . $id;
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('bukti')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengupload bukti.</div>');
        } else {
            if ($this->M_transaksi->do_upload_bukti($this->upload->data('file_name'))) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses mengupload bukti. Silakan tunggu konfirmasi dari admin!</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        }
        redirect('Pelanggan/client');
    }

    public function verifikasi_pembayaran()
    {
        $data['konten'] = 'transaksi/v_verifikasipembayaran';
        $data['active'] = 'Verifikasi';
        $data['judul'] = 'Verifikasi Pembayaran';
        $data['verifikasi'] = $this->M_transaksi->do_verifikasi_tampil();
        $data['hitung'] = $this->M_transaksi->do_verifikasi_hitung();
        $this->load->view('layout/template', $data);
    }

    public function transaksi_verifikasi($id)
    {
        $id_admin = $this->session->userdata('id_admin');
        if ($this->input->post('yes')) {
            $this->M_transaksi->do_setujui_verifikasi_tagihan($id, $id_admin);
        } else {
            $this->M_transaksi->do_tolak_verifikasi_tagihan($id, $id_admin);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses verifikasi. Silakan lihat histori transaksi!</div>');
        redirect('Transaksi/verifikasi_pembayaran');
    }

    public function histori_transaksi()
    {

        $data['konten'] = 'transaksi/v_historitransaksi';
        $data['active'] = 'Histori';
        $data['judul'] = 'Histori Transaksi';
        $data['histori'] = $this->M_transaksi->do_historitransaksi_tampil();
        $data['count'] = $this->M_transaksi->do_historitransaksi_hitung();
        $this->load->view('layout/template', $data);
    }
    public function filter_histori_transaksi()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['konten'] = 'transaksi/v_filterhistoritransaksi';
        $data['active'] = 'Histori';
        $data['judul'] = 'Histori Transaksi';
        $data['histori'] = $this->M_transaksi->do_filterhistoritransaksi_tampil($bulan, $tahun);
        $data['count'] = $this->M_transaksi->do_historitransaksi_hitung();
        $this->load->view('layout/template', $data);
    }

    public function cetak_laporan()
    {
        $data['judul'] = 'Laporan Transaksi';
        $data['cetak'] = $this->M_transaksi->do_cetak_laporan();
        $this->load->view('transaksi/v_cetaklaporan', $data);
    }
    public function cetak_filter_laporan()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['judul'] = 'Laporan Transaksi';
        $data['cetak'] = $this->M_transaksi->do_filter_cetak_laporan($bulan, $tahun);
        $this->load->view('transaksi/v_cetakfilterlaporan', $data, $bulan, $tahun);
    }
}
