<?php 

include_once("config.php");
if(isset($_GET['eid']) && (int)$_GET['eid'] > 0){
    $event_data = getEvents(array('eid' => (int)$_GET['eid']));
    if(count($event_data) == 1){
        mysqli_query($mysql_con, "DELETE FROM recurrence_type_1 WHERE event_id = ".(int)$_GET['eid']);
        mysqli_query($mysql_con, "DELETE FROM recurrence_type_2 WHERE event_id = ".(int)$_GET['eid']);
        mysqli_query($mysql_con, "DELETE FROM events WHERE id = ".(int)$_GET['eid']);
    }
}
header("location: ".SITE_URL);
exit;