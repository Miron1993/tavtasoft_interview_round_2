<?php 
function escapeString($str = ""){
    global $mysql_con;
    return mysqli_real_escape_string($mysql_con, $str);
}
function getEvents($filter = array()){
    global $mysql_con;

    $sql = "SELECT e.id, e.name, e.start_date, e.end_date, e.recurrence_type, e.recurrence_type_id, e.status FROM `events` e";
    $where = array();
    if(isset($filter['eid'])){
        $where[] = "e.id = ".(int)$filter['eid'];
    }
    if(isset($filter['status'])){
        $where[] = "e.status = ".(int)$filter['status'];
    }
    $sql .= " WHERE " . implode(" AND ", $where);

    $query = mysqli_query($mysql_con, $sql);
    $result = array();
    while($row = mysqli_fetch_assoc($query)){
        switch($row['recurrence_type']){
            case 'recurrence_type_1':
                $sql_1 = "SELECT `repeat_type`, `repeat_every` FROM `recurrence_type_1` WHERE event_id=".$row['id'];
                $query_1 = mysqli_query($mysql_con, $sql_1);
                $row_1 = mysqli_fetch_assoc($query_1);
                $row = array_merge($row, $row_1);
            break;
            case 'recurrence_type_2':
                $sql_2 = "SELECT `repeat_on`, `repeat_week`, `repeat_month` FROM `recurrence_type_2` WHERE event_id=".$row['id'];
                $query_2 = mysqli_query($mysql_con, $sql_2);
                $row_2 = mysqli_fetch_assoc($query_2);
                $row = array_merge($row, $row_2);
            break;
        }
        $result[] = $row;
    }
    return $result;
}