<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'FullCalendar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['appointment/create'] = 'Appointments/create';
$route['appointment/list-by-date'] = 'Appointments/getByDate';
$route['appointment/list-all'] = 'Appointments/getAll';
