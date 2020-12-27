<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AppointmentsModel', 'appointments');
	}

	public function create()
	{
		$appointment = [
			'appointment_date' => $this->input->post('appointment_date'),
			'appointment_time' => $this->input->post('appointment_time'),
			'customer_name' => $this->input->post('customer_name'),
		];
		$created = $this->appointments->create($appointment);

		echo json_encode(['status' => 'success', 'data' => 'Appointment registered succesfully.']);
	}

	public function getByDate()
	{
		$date = $this->input->get('date');
		$list = $this->appointments->getByDate($date);
		echo json_encode(['status' => 'success', 'data' => $list]);
	}

	public function getAllAsJson()
	{
		$list = $this->appointments->getAll();
		echo json_encode(['status' => 'success', 'data' => $list]);
	}

}

/* End of file Appointments.php */
/* Location: ./application/controllers/Appointments.php */