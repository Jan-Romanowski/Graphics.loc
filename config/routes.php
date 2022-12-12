<?php
return array(

	'users/register' => 'users/register',
	'users/login' => 'users/login',
	'users/logout' => 'users/logout',

	'calendar/switchMonth/([0-9]+)/([0-9]+)' => 'calendar/switchMonth/$1/$2',
	'calendar/clear/([0-9][0-9][0-9][0-9][-][0-9][0-9][-][0-9][0-9])/([0-9]+)' => 'calendar/clear/$1/$2',
	'calendar/addUserDay/([0-9]+)/([0-9]+)' => 'calendar/addUserDay/$1/$2',
	'calendar/view' => 'calendar/view',

	'queries/deleteQuery/([0-9]+)' => 'queries/deleteQuery/$1',
	'queries/transferQuery/([0-9]+)' => 'queries/transferQuery/$1',
	'queries' => 'queries/queriesView',

	'admin/index' => 'admin/index',
	'admin/switchMonth/([0-9]+)/([0-9]+)' => 'admin/switchMonth/$1/$2',
	'admin/addUserDay/([0-9]+)/([0-9]+)' => 'admin/addUserDay/$1/$2',
	'admin/view' => 'admin/view',
	'admin/userListShow' => 'admin/userListShow',
	'admin/daySettings/([0-9]+)' => 'admin/daySettings/$1',
	'admin/transferDayFromUserToFirm/([0-9]+)' => 'admin/transferDayFromUserToFirm/$1',
	'admin/deleteDayForUserFromFirmGraphic/([0-9]+)/([0-9][0-9][0-9][0-9][-][0-9][0-9][-][0-9][0-9])' => 'admin/deleteDayForUserFromFirmGraphic/$1/$2',

	'' => 'users/login',

);