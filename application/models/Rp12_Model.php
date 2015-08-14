<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Rp12_Model extends CI_Model 
{
	protected 	 $table = 'rp12';	 	 
	protected 	 $primary_key = 'id_rp12';

	public function __construct() {        
		parent::__construct();
	}
	
	public function displayAll(/*$offset=10, $limit=0*/)
	{
		//$this->db->limit($offset, $limit);
		$this->db->order_by($this->table .".date" . " desc ");
		$this->db->join('suspect','suspect.id_suspect ='.$this->table.'.suspect_id');
		$this->db->join('attorney','attorney.id_attorney ='.$this->table.'.attorney1');
		$query = $this->db->get($this->table);
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
	public function displaySelectedData($data)
	{
		$this->db->join('rp9','rp9.id_rp9 ='.$this->table.'.rp9_id');
		$this->db->join('rb2','rb2.id_rb2 ='.$this->table.'.rb2_id');
		$this->db->join('rt2','rt2.id_rt2 ='.$this->table.'.rt2_id');
		$this->db->join('rp7','rp7.id_rp7 =rp9.rp7_id');
		$this->db->join('rp6','rp6.id_rp6 =rp7.rp6_id');
		$this->db->join('suspect','suspect.id_suspect =rp6.suspect_id');
		$this->db->where($data);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function displayAllCase()
	{
		$this->db->join('rp9','rp9.id_rp9 ='.$this->table.'.rp9_id');
		$this->db->join('rb2','rb2.id_rb2 ='.$this->table.'.rb2_id');
		$this->db->join('rt2','rt2.id_rt2 ='.$this->table.'.rt2_id');
		$this->db->join('rp7','rp7.id_rp7 =rp9.rp7_id');
		$this->db->join('rp6','rp6.id_rp6 =rp7.rp6_id');
		$this->db->join('suspect','suspect.id_suspect =rp6.suspect_id');	
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function displayBetweenData($start, $finish)
	{
		$this->db->join('rp9','rp9.id_rp9 ='.$this->table.'.rp9_id');
		$this->db->join('rb2','rb2.id_rb2 ='.$this->table.'.rb2_id');
		$this->db->join('rt2','rt2.id_rt2 ='.$this->table.'.rt2_id');
		$this->db->join('rp7','rp7.id_rp7 =rp9.rp7_id');
		$this->db->join('rp6','rp6.id_rp6 =rp7.rp6_id');
		$this->db->join('suspect','suspect.id_suspect =rp6.suspect_id');	
		
		$this->db->where("tgl_rp12 >= '".$start."'");
		$this->db->where("tgl_rp12 <= '".$finish."'");
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function countAllData()
	{
		return $this->db->count_all_results($this->table);
	}
	
	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}
	
	public function send($data)
	{
		return $this->db->insert($this->table, $data);
	}
	
	public function update($data, $where)
	{
		$this->db->where($where);
		return $this->db->update($this->table, $data);
	}
	
	public function delete($where)
	{
		return $this->db->delete($this->table, $where);
	}
	
	public function insert_id()
	{
		return $this->db->insert_id();
	}
}
?>