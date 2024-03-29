<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{

    public $table = 'kriteria';
    public $id = 'id_kriteria';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
        function select($id_user,$jenis_lelang){
        
        $query =  $this->db->query("SELECT * FROM `kriteria` a, perusahaan b, barang c WHERE a.id_perusahaan=c.id_perusahaan  and a.id_user=$id_user and a.id_perusahaan=b.id_perusahaan and c.jenis_lelang='$jenis_lelang'");
        return $query->result();
    }
    function maks_kriteria($id_user,$jenis_lelang){
        
        $query =  $this->db->query("SELECT max(a.kriteria1) as maxK1, max(a.kriteria2) as maxK2, max(a.kriteria3) as maxK3,max(a.kriteria4) as maxK4 FROM kriteria a, barang b WHERE a.id_user=$id_user and b.id_perusahaan=a.id_perusahaan and b.jenis_lelang='$jenis_lelang'");
        return $query->result();
    }
    function mins_kriteria($id_user,$jenis_lelang){
        
        $query =  $this->db->query("SELECT min(a.kriteria1) as maxK1, min(a.kriteria2) as maxK2, min(a.kriteria3) as maxK3,min(a.kriteria4) as maxK4 FROM kriteria a, barang b WHERE a.id_user=$id_user and b.id_perusahaan=a.id_perusahaan and b.jenis_lelang='$jenis_lelang'");
        return $query->result();
    }
    function insert_nilai($a,$b,$c){
        $query =  $this->db->query("INSERT INTO `nilai`(`id_perusahaan`, `nilai`,jenis_lelang) VALUES ($a,$b,'$c')"); 
        return $query;
    }
function update_nilai($a,$b,$c){
        $query =  $this->db->query("UPDATE `nilai` SET `nilai`=$b WHERE `id_perusahaan`=$a and jenis_lelang='$c' ");
        
        return $query;
    }
    function reset(){
        $query =  $this->db->query("DELETE FROM `nilai` WHERE 1");
        
        return $query;
    }

    // datatables
    function json() {
        $this->datatables->select('id_kriteria,id_perusahaan,id_user,kriteria1,kriteria2,kriteria3,kriteria4');
        $this->datatables->from('kriteria');
        //add this line for join
        //$this->datatables->join('table2', 'kriteria.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('kriteria/update/$1'),'Ubah')." | ".anchor(site_url('kriteria/delete/$1'),'Hapus','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kriteria');
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_kriteria', $q);
	$this->db->or_like('id_perusahaan', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('kriteria1', $q);
	$this->db->or_like('kriteria2', $q);
	$this->db->or_like('kriteria3', $q);
	$this->db->or_like('kriteria4', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kriteria', $q);
	$this->db->or_like('id_perusahaan', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('kriteria1', $q);
	$this->db->or_like('kriteria2', $q);
	$this->db->or_like('kriteria3', $q);
	$this->db->or_like('kriteria4', $q);
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

}

/* End of file Kriteria_model.php */
/* Location: ./application/models/Kriteria_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-03 20:39:15 */
/* http://harviacode.com */