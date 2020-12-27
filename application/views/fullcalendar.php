<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css" integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" />
	<title>Codeigniter Full Calendar Example</title>
</head>
<body>
	<div class="container pt-5">
		<div class="card">
			<div class="card-header bg-primary border-primary text-white">Add New Appointment</div>
			<div class="card-body">
				<form action="#" onsubmit="return false;" class="form-horizontal">
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="appointment_date">Date</label>
								<input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="appointment_time">Time</label>
								<input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="customer_name">Customer Name</label>
								<input type="text" class="form-control" id="customer_name" name="customer_name" required>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label for="">&nbsp;</label>
								<button type="submit" class="btn btn-primary btn-block" id="submit_appointment">Create</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card card-body mt-3">
			<div class="row">
				<div class="col-lg-12">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js" integrity="sha256-mMw9aRRFx9TK/L0dn25GKxH/WH7rtFTp+P9Uma+2+zc=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
	<script>
		var calendar = undefined;
		/**
		 * Initialize calendar
		 */
		function initFullCalendar() {
			var calendarEl = document.getElementById('calendar');
			calendar = new FullCalendar.Calendar(calendarEl, {
				initialView: 'dayGridMonth',
				selectable: true,
				dateClick: function(info) {
					// when clicked on a date cell
					// showAppointments(info.dateStr);
				},
				events: <?php echo json_encode($events); ?>
			});

			calendar.render();
		}

		/**
		 * Create new appointment
		 */
		function createAppointment() {
			let data = {
				appointment_date: $('#appointment_date').val(),
				appointment_time: $('#appointment_time').val(),
				customer_name: $('#customer_name').val(),
			};
			var date = moment(data.appointment_date + ' ' + data.appointment_time);

			if (date.isValid()) {
				calendar.addEvent({
					title: data.customer_name,
					start: date.format(),
					end: date.format(),
					allDay: false
	            });

				$.post('<?php echo site_url('appointment/create'); ?>', data, function(res){
					if (res.status === 'success') {
						toastr.success('Appointment created successfully.', 'Success');
					} else {
						toastr.error('Failed to create the appointment. Please try again later.', 'Failed');
					}
				}, 'json');

			} else {
				toastr.error('Invalid date. Please try again later.', 'Failed');
			}
		}

		/**
		 * Triggered when clicked on create buton
		 */
		$('#submit_appointment').click(function(){
			createAppointment();
		});

		/**
		 * Show the list of appointments registered for the date
		 */
		function showAppointments(dateStr) {
			$.get('<?php echo site_url('appointment/list-by-date'); ?>', {date: dateStr}, function(res){
				console.log(res);
			}, 'json');
		}

		$(function(){
			initFullCalendar();
		});
	</script>
</body>
</html>