<?php 
include_once("config.php");
$submit_action = isset($_POST['submit_action']) ? $_POST['submit_action'] : "";
switch($submit_action){
    case 'event_add_edit':
        if(empty(trim($_POST['name']))){
            $_SESSION['errors']['invalid_name'] = "Please Enter Title";
        }
        if(empty(trim($_POST['start_date']))){
            $_SESSION['errors']['invalid_start_date'] = "Please Enter Start Date";
        }
        if(empty(trim($_POST['end_date']))){
            $_SESSION['errors']['invalid_end_date'] = "Please Enter End Date";
        }
        if(empty(trim($_POST['end_date']))){
            $_SESSION['errors']['invalid_end_date'] = "Please Enter End Date";
        }
        if(strtotime($_POST['end_date']) < strtotime($_POST['start_date'])){
            $_SESSION['errors']['invalid_start_date'] = "Start Date should not greater than End Date";
        }
        if(empty(trim($_POST['recurrence_type']))){
            $_SESSION['errors']['invalid_recurrence_type'] = "Please Choose Recurrence Type";
        }
        if(count($_SESSION['errors'])){
            $url = SITE_URL."add_edit_form.php";
            if((int)$_POST['eid'] > 0){
                $url .= "?eid=".(int)$_POST['eid'];
            }
            header("location: ".$url);
            exit;
        }

        $datetime = date("Y-m-d H:i:s");
        if((int)$_POST['eid'] > 0){
            mysqli_query($mysql_con, "DELETE FROM recurrence_type_1 WHERE event_id = ".(int)$_POST['eid']);
            mysqli_query($mysql_con, "DELETE FROM recurrence_type_2 WHERE event_id = ".(int)$_POST['eid']);
            $sql = "UPDATE `events` SET `name`='".escapeString($_POST['name'])."',`start_date`='".$_POST['start_date']."',`end_date`='".$_POST['end_date']."',`recurrence_type`='".escapeString($_POST['recurrence_type'])."',`date_modified`='".$datetime."' WHERE id=".(int)$_POST['eid'];
            mysqli_query($mysql_con, $sql);
        }else{
            $sql = "INSERT INTO `events`(`name`, `start_date`, `end_date`, `recurrence_type`, `date_added`, `date_modified`) VALUES ('".escapeString($_POST['name'])."','".$_POST['start_date']."','".$_POST['end_date']."','".escapeString($_POST['recurrence_type'])."','".$datetime."','".$datetime."')";
            mysqli_query($mysql_con, $sql);
            $_POST['eid'] = mysqli_insert_id($mysql_con);
        }

        $recurrence_type_id = 0;
        switch($_POST['recurrence_type']){
            case 'recurrence_type_1':
                $sql = "INSERT INTO `recurrence_type_1`(`event_id`, `repeat_type`, `repeat_every`, `date_added`) VALUES ('".(int)$_POST['eid']."','".escapeString($_POST['recurrence_type_1_repeat_type'])."','".escapeString($_POST['recurrence_type_1_repeat_every'])."','".$datetime."')";
                mysqli_query($mysql_con, $sql);
                $recurrence_type_id = mysqli_insert_id($mysql_con);
            break;
            case 'recurrence_type_2':
                $sql = "INSERT INTO `recurrence_type_2`(`event_id`, `repeat_on`, `repeat_week`, `repeat_month`, `date_added`) VALUES ('".(int)$_POST['eid']."','".escapeString($_POST['recurrence_type_2_repeat_on'])."','".escapeString($_POST['recurrence_type_2_repeat_week'])."','".escapeString($_POST['recurrence_type_2_repeat_month'])."','".$datetime."')";
                mysqli_query($mysql_con, $sql);
                $recurrence_type_id = mysqli_insert_id($mysql_con);
            break;
        }
        $sql = "UPDATE `events` SET `recurrence_type_id`=$recurrence_type_id, `date_modified`='".$datetime."' WHERE id=".(int)$_POST['eid'];
        mysqli_query($mysql_con, $sql);

        header("location: ".SITE_URL);
        exit;
        break;
}
