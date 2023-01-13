<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->model('M_tarif');
        $this->load->model('M_transaksi');
    }

    public function index()
    {
        $this->load->view('auth/v_pelangganlogin');
    }

    public function pelanggan_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->M_pelanggan->do_pelanggan_login()->num_rows() > 0) {
                $data = $this->M_pelanggan->do_pelanggan_login()->row();
                $datapelanggan = array(
                    'login' => TRUE,
                    'username' => $data->username,
                    'nama_pelanggan' => $data->nama_pelanggan,
                    'id_pelanggan' => $data->id_pelanggan
                );
                $this->session->set_userdata($datapelanggan);
                redirect('Pelanggan/client', 'refresh');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal Login. Periksa username dan password Anda!</div>');
                redirect('Pelanggan');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
            redirect('Pelanggan');
        }
    }

    public function register()
    {
        $data['tarif'] = $this->M_tarif->do_tarif_tampil();
        $this->load->view('auth/v_pelangganregister', $data);
    }

    public function pelanggan_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required|numeric', array('required' => 'Nomor Meter harus diisi.'));
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi.'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi.'));
        $this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('register')) {
                $cek = $this->M_pelanggan->cek_nomormeter();
                if ($cek == 0) {
                    if ($this->M_pelanggan->do_pelanggan_tambah() == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses registrasi.</div>');
                        redirect('Pelanggan');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal registrasi.</div>');
                        redirect('Pelanggan/register');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Nomor Meter sudah ada.</div>');
                    redirect('Pelanggan/register');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                redirect('Pelanggan/register');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
            redirect('Pelanggan/register');
        }
    }

    public function data_pelanggan()
    {
        $data['konten'] = 'masterdata/v_pelanggan';
        $data['count'] = $this->M_pelanggan->do_pelanggan_hitung();
        $data['pelanggan'] = $this->M_pelanggan->do_pelanggan_tampil();
        $data['tarif'] = $this->M_tarif->do_tarif_tampil();
        $data['active'] = 'Pelanggan';
        $data['judul'] = 'Pelanggan';
        $this->load->view('layout/template', $data);
    }

    public function pelanggan_tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required|numeric', array('required' => 'Nomor Meter harus diisi.'));
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi.'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi.'));
        $this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('tambah')) {
                $cek = $this->M_pelanggan->cek_nomormeter();
                if ($cek == 0) {
                    if ($this->M_pelanggan->do_pelanggan_tambah() == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah pelanggan.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah pelanggan.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning">Nomor Meter sudah ada.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Pelanggan/data_pelanggan');
    }

    public function get_pelanggan_id($id)
    {
        $data = $this->M_pelanggan->get_datapelanggan_id($id);
        echo (json_encode($data));
    }

    public function pelanggan_ubah()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
        $this->form_validation->set_rules('nomor_kwh', 'Nomor Meter', 'trim|required|numeric', array('required' => 'Nomor Meter harus diisi.'));
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required', array('required' => 'Nama Pelanggan harus diisi.'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => 'Alamat harus diisi.'));
        $this->form_validation->set_rules('id_tarif', 'Daya', 'trim|required', array('required' => 'Daya harus diisi.'));
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('ubah')) {
                if ($this->M_pelanggan->do_pelanggan_ubah() == TRUE) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses mengubah pelanggan.</div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengubah pelanggan.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning">' . validation_errors() . '</div>');
        }
        redirect('Pelanggan/data_pelanggan');
    }

    public function pelanggan_hapus($id = '')
    {
        $hapus = $this->M_pelanggan->do_pelanggan_hapus($id);
        if ($hapus == TRUE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menghapus pelanggan.</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus pelanggan.</div>');
        }
        redirect('Pelanggan/data_pelanggan');
    }

    public function client()
    {
        $data['lunas'] = $this->M_transaksi->do_tampiltagihan_lunas();
        $data['ditolak'] = $this->M_transaksi->do_tampiltagihan_ditolak();
        $data['pending'] = $this->M_transaksi->do_tampiltagihan_pending();
        $data['belum'] = $this->M_transaksi->do_tampiltagihan_belum();
        $this->load->view('layout/client', $data);
    }

    public function pelanggan_logout()
    {
        $this->session->sess_destroy();
        redirect('Pelanggan', 'refresh');
    }
}
