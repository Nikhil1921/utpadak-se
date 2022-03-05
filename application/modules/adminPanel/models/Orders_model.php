<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Orders_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'o.mobile', 'o.total_amount'];
	public $search_column = ['o.id', 'o.name', 'o.mobile', 'o.total_amount'];
    public $order_column = [null, 'o.name', 'o.mobile', 'o.total_amount', null];
	public $order = ['o.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('o.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('o.id')
		         ->from($this->table)
				 ->where('o.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}