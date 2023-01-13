<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
    public function do_cek_penggunaan()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $bulan        = $this->input->post('bulan');
        $tahun        = $this->input->post('tahun');

        return $this->db->query("SELECT * FROM penggunaan WHERE id_pelanggan='$id_pelanggan' AND bulan='$bulan' AND tahun='$tahun'")->row();
    }

    public function do_penggunaan_tambah()
    {
        $id_pelanggan   = $this->input->post('id_pelanggan');
        $bulan          = $this->input->post('bulan');
        $tahun          = $this->input->post('tahun');
        $meter_awal     = $this->input->post('meter_awal');
        $meter_akhir    = $this->input->post('meter_akhir');
        $jumlah_meter   = $meter_akhir - $meter_awal;

        $this->db->query("INSERT INTO penggunaan VALUES('', '$id_pelanggan', '$bulan', '$tahun', '$meter_awal', '$meter_akhir', '$jumlah_meter', '0')");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function do_penggunaan_detail($id)
    {
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id' ORDER BY penggunaan.id_penggunaan DESC")->result();
    }

    public function do_penggunaan_detail_hitung($id)
    {
        return $this->db->query("SELECT * FROM penggunaan WHERE penggunaan.id_pelanggan='$id'")->num_rows();
    }

    public function do_tampiltagihan_lunas()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id_pelanggan' AND status=3")->result();
    }

    public function do_tampiltagihan_ditolak()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id_pelanggan' AND status=2")->result();
    }

    public function do_tampiltagihan_pending()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id_pelanggan' AND status=1")->result();
    }

    public function do_tampiltagihan_belum()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        return $this->db->query("SELECT * FROM penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan=pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif=tarif.id_tarif
                                WHERE penggunaan.id_pelanggan='$id_pelanggan' AND status=0")->result();
    }

    public function do_upload_bukti($filename)
    {
        $id_penggunaan  = $this->input->post('id_penggunaan');
        $tanggal        = date('Y-m-d');
        $bulan_bayar    = $this->input->post('bulan_bayar');
        $total          = $this->input->post('grandtotal') + 2500;

        $cek = $this->db->query("SELECT * FROM penggunaan WHERE status=2 AND id_penggunaan='$id_penggunaan'")->row();
        if ($cek == null) {
            $insert = $this->db->query("INSERT INTO pembayaran VALUES('', '$id_penggunaan', '$tanggal', '$bulan_bayar', '2500', '$total', '', '$filename', '1')");
            if ($insert) {
                return $this->db->query("UPDATE penggunaan SET status=1 WHERE id_penggunaan='$id_penggunaan'");
            }
        } else {
            $update = $this->db->query("UPDATE pembayaran SET bukti='$filename', status=1 WHERE id_penggunaan='$id_penggunaan'");
            if ($update) {
                return $this->db->query("UPDATE penggunaan SET status=1 WHERE id_penggunaan='$id_penggunaan'");
            }
        }
    }

    public function do_verifikasi_tampil()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                INNER JOIN penggunaan ON pembayaran.id_penggunaan = penggunaan.id_penggunaan
                                INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                WHERE pembayaran.status=1
                                ORDER BY id_pembayaran DESC")->result();
    }

    public function do_verifikasi_hitung()
    {
        return $this->db->query("SELECT * FROM pembayaran WHERE status='1'")->num_rows();
    }

    public function do_setujui_verifikasi_tagihan($id, $id_admin)
    {
        $this->db->query("UPDATE penggunaan SET status=3 WHERE id_penggunaan='$id'");
        $this->db->query("UPDATE pembayaran SET id_admin='$id_admin', status=3 WHERE id_penggunaan='$id'");
    }

    public function do_tolak_verifikasi_tagihan($id, $id_admin)
    {
        $this->db->query("UPDATE penggunaan SET status=2 WHERE id_penggunaan='$id'");
        $this->db->query("UPDATE pembayaran SET id_admin='$id_admin', status=2 WHERE id_penggunaan='$id'");
    }

    public function do_historitransaksi_tampil()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN penggunaan ON pembayaran.id_penggunaan = penggunaan.id_penggunaan
                                LEFT JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                LEFT JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                LEFT JOIN admin ON pembayaran.id_admin = admin.id_admin
                                ORDER BY id_pembayaran DESC")->result();
    }
    public function do_filterhistoritransaksi_tampil($bulan, $tahun)
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN penggunaan ON pembayaran.id_penggunaan = penggunaan.id_penggunaan
                                LEFT JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                LEFT JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                LEFT JOIN admin ON pembayaran.id_admin = admin.id_admin
                                WHERE penggunaan.bulan = '$bulan'
                                AND penggunaan.tahun = '$tahun'
                                AND penggunaan.status = 3
                                ORDER BY id_pembayaran DESC")->result();
    }

    public function do_historitransaksi_hitung()
    {
        return $this->db->query("SELECT * FROM pembayaran")->num_rows();
    }

    public function do_cetak_laporan()
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN penggunaan ON pembayaran.id_penggunaan = penggunaan.id_penggunaan
                                LEFT JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                LEFT JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                LEFT JOIN admin ON pembayaran.id_admin = admin.id_admin
                                WHERE pembayaran.status=3 ORDER BY pembayaran.id_pembayaran DESC")->result();
    }
    public function do_filter_cetak_laporan($bulan, $tahun)
    {
        return $this->db->query("SELECT * FROM pembayaran
                                LEFT JOIN penggunaan ON pembayaran.id_penggunaan = penggunaan.id_penggunaan
                                LEFT JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan
                                LEFT JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
                                LEFT JOIN admin ON pembayaran.id_admin = admin.id_admin
                                WHERE penggunaan.bulan = '$bulan'
                                AND penggunaan.tahun = '$tahun'
                                AND penggunaan.status = 3
                                ORDER BY id_pembayaran DESC")->result();
    }
}
