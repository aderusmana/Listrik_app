<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
        $this->load->model('M_transaksi');
        $this->load->model('M_pelanggan');
        $this->load->model('M_tarif');
    }

    public function index()
    {
        $data['countpelanggan'] = $this->M_pelanggan->do_pelanggan_hitung();
        $data['counttarif'] = $this->M_tarif->do_tarif_hitung();
        $data['counthistori'] = $this->M_transaksi->do_historitransaksi_hitung();
        $data['countpenggunaan'] = $this->M_dashboard->do_penggunaan_hitung();
        $data['konten'] = 'v_dashboard';
        $data['active'] = 'Dashboard';
        $data['judul'] = 'Dashboard';
        $this->load->view('layout/template', $data);
    }
}
