<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modeldataizinkeluar extends Model
{
    protected $table = "izin";
    protected $column_order = array(null, 'izin_nomor','nama','nama_kelas','izin_tgl','izin_jam','izin_jamkmbli','izin_keperluan','telp','izin_status', null);
    protected $column_search = array('nama', 'izin_tgl');
    protected $order = array('nama' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        // $this->dt = $this->db->table($this->table)->select('*')->join('kelas', 'id_kelas=santri_idkelas')->join('kamar', 'id_kamar=santri_idkamar');
    }
    private function _get_datatables_query($tglawal, $tglakhir)
    {
        if ($tglawal == '' && $tglakhir == '') {
            $this->dt = $this->db->table($this->table)->join('kelas', 'id_kelas=izin_kelas')->join('kamar', 'id_kamar=izin_kamar')->join('santri', 'nis=izin_nis')
            ->where('izin_type', 'Keluar')
            ->where('izin_status', 'Masih Izin');
        }else{
         $this->dt = $this->db->table($this->table)->join('kelas', 'id_kelas=izin_kelas')->join('kamar', 'id_kamar=izin_kamar')->join('santri', 'nis=izin_nis')
         ->where('izin_type', 'Keluar')
         ->where('izin_tgl >=',$tglawal)
         ->where('izin_tgl <=',$tglakhir)
         ->where('izin_status', 'Masih Izin');
     }

     $i = 0;
     foreach ($this->column_search as $item) {
        if ($this->request->getPost('search')['value']) {
            if ($i === 0) {
                $this->dt->groupStart();
                $this->dt->like($item, $this->request->getPost('search')['value']);
            } else {
                $this->dt->orLike($item, $this->request->getPost('search')['value']);
            }
            if (count($this->column_search) - 1 == $i)
                $this->dt->groupEnd();
        }
        $i++;
    }

    if ($this->request->getPost('order')) {
        $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
    } else if (isset($this->order)) {
        $order = $this->order;
        $this->dt->orderBy(key($order), $order[key($order)]);
    }
}
function get_datatables($tglawal,$tglakhir)
{
    $this->_get_datatables_query($tglawal,$tglakhir);
    if ($this->request->getPost('length') != -1)
        $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
    $query = $this->dt->get();
    return $query->getResult();
}
function count_filtered($tglawal,$tglakhir)
{
    $this->_get_datatables_query($tglawal,$tglakhir);
    return $this->dt->countAllResults();
}
public function count_all($tglawal,$tglakhir)
{
    if ($tglawal == '' && $tglakhir == '') {
        $tbl_storage = $this->db->table($this->table)->join('kelas', 'id_kelas=izin_kelas')->join('kamar', 'id_kamar=izin_kamar')->join('santri', 'nis=izin_nis')
        ->where('izin_type', 'Keluar')
        ->where('izin_status', 'Masih Izin');
    }else{
        $tbl_storage = $this->db->table($this->table)->join('kelas', 'id_kelas=izin_kelas')->join('kamar', 'id_kamar=izin_kamar')->join('santri', 'nis=izin_nis')
        ->where('izin_type', 'Keluar')
        ->where('izin_tgl >=',$tglawal)
        ->where('izin_tgl <=',$tglakhir)
        ->where('izin_status', 'Masih Izin');
    }
    return $tbl_storage->countAllResults();
}
}