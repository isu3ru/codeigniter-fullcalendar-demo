<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentsModel extends CI_Model {

	public function create($data)
	{
		return $this->db->insert('appointments', $data);
	}

	public function getByDate($date)
	{
		$this->db->where('appointment_date', $date);
		$this->db->order_by('appointment_time', 'asc');
		return $this->db->get('appointments')->result_array();
	}

	public function getAll()
	{
		$this->db->order_by('appointment_time', 'asc');
		return $this->db->get('appointments')->result_array();
	}

}

/* End of file AppointmentsModel.php */
/* Location: ./application/models/AppointmentsModel.php */