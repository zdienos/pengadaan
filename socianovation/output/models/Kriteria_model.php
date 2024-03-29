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

    // datatables
    function json() {
        $this->datatables->select('id_kriteria,id_perusahaan,id_user,kriteria1,kriteria2,kriteria3,kriteria4');
        $this->datatables->from('kriteria');
        //add this line for join
        //$this->datatables->join('table2', 'kriteria.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('kriteria/read/$1'),'Read')." | ".anchor(site_url('kriteria/update/$1'),'Update')." | ".anchor(site_url('kriteria/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_kriteria');
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
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-03 20:30:47 */
/* http://harviacode.com */