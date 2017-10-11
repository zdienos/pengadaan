<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statusnilai_model extends CI_Model
{

    public $table = 'statusnilai';
    public $id = 'id_statusnilai';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_statusnilai,jenis_lelang,estimasi,tkdn,spesifikasi');
        $this->datatables->from('statusnilai');
        //add this line for join
        //$this->datatables->join('table2', 'statusnilai.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('statusnilai/read/$1'),'Read')." | ".anchor(site_url('statusnilai/update/$1'),'Update')." | ".anchor(site_url('statusnilai/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_statusnilai');
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
        $this->db->like('id_statusnilai', $q);
	$this->db->or_like('jenis_lelang', $q);
	$this->db->or_like('estimasi', $q);
	$this->db->or_like('tkdn', $q);
	$this->db->or_like('spesifikasi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_statusnilai', $q);
	$this->db->or_like('jenis_lelang', $q);
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

}

/* End of file Statusnilai_model.php */
/* Location: ./application/models/Statusnilai_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-25 12:43:36 */
/* http://harviacode.com */