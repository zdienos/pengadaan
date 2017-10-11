<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public $table = 'barang';
    public $id = 'id_barang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_barang,id_perusahaan,jenis_lelang,FORMAT(harga, 2) as harga,estimasi,tkdn,spesifikasi');
        $this->datatables->from('barang');
        //add this line for join
        //$this->datatables->join('table2', 'barang.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('barang/read/$1'),'Lihat')." | ".anchor(site_url('barang/update/$1'),'Ubah')." | ".anchor(site_url('barang/delete/$1'),'Hapus','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_barang');
        return $this->datatables->generate();
    }
    // datatables
    function json2($id) {
        $this->datatables->select('id_barang,id_perusahaan,jenis_lelang,FORMAT(harga, 2) as harga,estimasi,tkdn,spesifikasi');
        $this->datatables->from('barang');
        $this->datatables->where('id_perusahaan', $id);
        //add this line for join
        //$this->datatables->join('table2', 'barang.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('barang/read/$1'),'Lihat')." | ".anchor(site_url('barang/update/$1'),'Ubah')." | ".anchor(site_url('barang/delete/$1'),'Hapus','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_barang');
        return $this->datatables->generate();
    }

    function json3() {
        $this->datatables->select('id_barang,id_perusahaan,jenis_lelang,FORMAT(harga, 2) as harga,estimasi,tkdn,spesifikasi');
        $this->datatables->from('barang');
        //add this line for join
        //$this->datatables->join('table2', 'barang.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('barang/read/$1'),'Lihat'),'id_barang');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get data by id
    function get_by_idperusahaan($id_perusahaan)
    {
        $this->db->where('id_perusahaan', $id_perusahaan);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_barang', $q);
    $this->db->or_like('id_perusahaan', $q);
    $this->db->or_like('jenis_lelang', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('estimasi', $q);
	$this->db->or_like('tkdn', $q);
	$this->db->or_like('spesifikasi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_barang', $q);
    $this->db->or_like('id_perusahaan', $q);
    $this->db->or_like('jenis_lelang', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('estimasi', $q);
	$this->db->or_like('tkdn', $q);
	$this->db->or_like('spesifikasi', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function update_kriteria($id_perushaan,$a,$b,$c,$d)
    {
        return $this->db->query("UPDATE `kriteria` SET `kriteria1`=$a,`kriteria2`=$b,`kriteria3`=$c,`kriteria4`=$d WHERE id_perusahaan=$id_perushaan");
    }

}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-06 14:54:06 */
/* http://harviacode.com */