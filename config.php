<?php
define('SITE_URL', "http://localhost/tatvasoft_practice/");

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tatvasoft_practice');
$mysql_con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysql_con) die("Database connection failed");

const RECURRENCE_TYPES = array(
    'recurrence_type_1' => 'Repeat',
    'recurrence_type_2' => 'Repeat on the',
);
const RECURRENCE_TYPE_ONE_REPEAT_TYPE = array(
    'every' => 'Every',
    'every_other' => 'Every Other',
    'every_third' => 'Every Third',
    'every_fourth' => 'Every Fourth',
);
const RECURRENCE_TYPE_ONE_REPEAT_EVERY = array(
    'day' => 'Day',
    'week' => 'Week',
    'month' => 'Month',
    'year' => 'Year',
);
const RECURRENCE_TYPE_TWO_REPEAT_ON = array(
    'first' => 'First',
    'second' => 'Second',
    'third' => 'Third',
    'fourth' => 'Fourth',
);
const RECURRENCE_TYPE_TWO_REPEAT_WEEK = array(
    'sunday' => 'Sun',
    'monday' => 'Mon',
    'tuesday' => 'Tue',
    'wednesday' => 'Wed',
    'thursday' => 'Thu',
    'friday' => 'Fri',
    'satusday' => 'Sat',
);
const RECURRENCE_TYPE_TWO_REPEAT_MONTH = array(
    '1' => 'Month',
    '3' => '3 Months',
    '4' => '4 Months',
    '6' => '6 Months',
    '12' => 'Year',
);
session_start();

include_once("db/db_functions.php");