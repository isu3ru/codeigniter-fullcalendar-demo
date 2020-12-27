<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FullCalendar extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('AppointmentsModel', 'appointments');
	}

	public function index()
	{
		$list = $this->appointments->getAll();
		$events = $this->_getEventsFromAppointments($list);
		$this->load->view('fullcalendar', [
			'events' => $events,
		]);
	}

	private function _getEventsFromAppointments($appointments) {
		$_evts = [];

		foreach ($appointments as $appointment) {
			$_dt = sprintf('%s %s', $appointment['appointment_date'], $appointment['appointment_time']);
			$_isoStr = date('c', strtotime($_dt));
			$_evts[] = [
				'start' => $_isoStr,
				'end' => $_isoStr,
				'title' => $appointment['customer_name'],
			];
		}
		return $_evts;
	}

}
