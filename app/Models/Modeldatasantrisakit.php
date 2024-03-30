<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modeldatasantrisakit extends Model
{
    protected $table = "santri";
    protected $column_order = array(null, null, 'nis','nama','jenkel','id_kelas','alamat','telp', null);
    protected $column_search = array('nis','nama');
    protected $order = array('nis' => 'asc');
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
    private function _get_datatables_query($kode_musrif)
    {

        if ($kode_musrif == session()->iduser) {
         $this->dt = $this->db->table($this->table)->select('*')
         ->join('kelas', 'id_kelas=santri_idkelas')
         ->join('kamar', 'id_kamar=santri_idkamar')
         ->join('musrif', 'musrif_kamar=kode_musrif')
         // ->join('user', 'user.jenkel=santri.jenkel')
         
         ->where('musrif_kamar', $kode_musrif);

     }else{
         $this->dt = $this->db->table($this->table)->select('*')
         ->join('kelas', 'id_kelas=santri_idkelas')
         ->join('kamar', 'id_kamar=santri_idkamar')
         ->join('musrif', 'musrif_kamar=kode_musrif')
         ->where('musrif_kamar', $kode_musrif);

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
function get_datatables($kode_musrif)
{
    $this->_get_datatables_query($kode_musrif);
    if ($this->request->getPost('length') != -1)
        $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
    $query = $this->dt->get();
    return $query->getResult();
}
function count_filtered($kode_musrif)
{
    $this->_get_datatables_query($kode_musrif);
    return $this->dt->countAllResults();
}
public function count_all($jenkel, $kode_musrif)
{
    if ($kode_musrif == session()->iduser) {
        $tbl_storage = $this->db->table($this->table)->select('*')
        ->join('kelas', 'id_kelas=santri_idkelas')
        ->join('kamar', 'id_kamar=santri_idkamar')
        ->join('musrif', 'musrif_kamar=kode_musrif')
        // ->join('user', 'user.jenkel=santri.jenkel')
        
        ->where('musrif_kamar', $kode_musrif);

    }else{

      $tbl_storage = $this->db->table($this->table)->select('*')
      ->join('kelas', 'id_kelas=santri_idkelas')
      ->join('kamar', 'id_kamar=santri_idkamar')
      ->join('musrif', 'musrif_kamar=kode_musrif')
      ->where('musrif_kamar', $kode_musrif);
  }
        // $tbl_storage = $this->db->table($this->table);
  return $tbl_storage->countAllResults();
}
}