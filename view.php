<?php 
include_once("config.php");
$event_data = array();
if(isset($_GET['eid']) && (int)$_GET['eid'] > 0){
    $event_data = getEvents(array('eid' => (int)$_GET['eid']));
    $event_data = $event_data[0];
}
if(count($event_data) == 0){
    header("location: ".SITE_URL);
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Event View #<?=$event_data['name']?> | Tatvasoft Pratical Test</title>
        <link href="css/boostrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-4">
                    <h2>Event View #<?=$event_data['id']?></h2>
                    <h4><?=$event_data['name']?></h4>
                    <hr/>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="align-middle" scope="col">Date</th>
                                <th class="align-middle" scope="col">Day Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $recurrence_count = 0;
                        while(strtotime($event_data['start_date']) < strtotime($event_data['end_date'])){
                            switch($event_data['recurrence_type']){
                                case 'recurrence_type_1': ?>
                                    <tr>
                                        <td class="align-middle"><?=$event_data['start_date']?></td>
                                        <td class="align-middle"><?=date("l", strtotime($event_data['start_date']))?></td>
                                    </tr>
                                    <?php 
                                    $recurrence_count++;
                                    switch($event_data['repeat_type']){
                                        case 'every':
                                            $event_data['start_date'] = date("Y-m-d", strtotime($event_data['start_date']. " +1 ".ucwords($event_data['repeat_every'])));
                                        break;
                                        case 'every_other':
                                            $event_data['start_date'] = date("Y-m-d", strtotime($event_data['start_date']. " +2 ".ucwords($event_data['repeat_every'])));
                                        break;
                                        case 'every_third':
                                            $event_data['start_date'] = date("Y-m-d", strtotime($event_data['start_date']. " +3 ".ucwords($event_data['repeat_every'])));
                                        break;
                                        case 'every_fourth':
                                            $event_data['start_date'] = date("Y-m-d", strtotime($event_data['start_date']. " +4 ".ucwords($event_data['repeat_every'])));
                                        break;
                                        default:
                                            $event_data['start_date'] = date("Y-m-d", strtotime($event_data['start_date']. " +1 Day"));
                                        break;
                                    }
                                break;
                                case 'recurrence_type_2':
                                    $start = new DateTime($event_data['start_date']);
                                    $end = new DateTime($event_data['end_date']);
                                    $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of next month';
                                    if((int)$event_data['repeat_month'] == 12){
                                        $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of next year';
                                    }elseif((int)$event_data['repeat_month'] == 1){
                                        $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of next month';
                                    }elseif((int)$event_data['repeat_month'] == 3){
                                        $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of 3 months';
                                    }elseif((int)$event_data['repeat_month'] == 4){
                                        $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of 4 months';
                                    }elseif((int)$event_data['repeat_month'] == 6){
                                        $month_str = $event_data['repeat_on'].' '.$event_data['repeat_week'].' of 6 months';
                                    }
                                    $interval = DateInterval::createFromDateString($month_str);
                                    $period = new DatePeriod($start, $interval, $end, DatePeriod::EXCLUDE_START_DATE);
                                    $next_date = "";
                                    foreach($period as $time) {
                                        $next_date = date("Y-m-d", strtotime($time->format("Y-m-d")));
                                        break;
                                    }
                                    if($next_date){
                                        $recurrence_count++;
                                        $event_data['start_date'] = $next_date; ?>
                                        <tr>
                                            <td class="align-middle"><?=$event_data['start_date']?></td>
                                            <td class="align-middle"><?=date("l", strtotime($event_data['start_date']))?></td>
                                        </tr>
                                        <?php 
                                    }else{
                                        $event_data['start_date'] = $event_data['end_date'];
                                    }
                                break;
                            }
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="align-middle" scope="col">Total Recurrence Event:</th>
                                <th class="align-middle" scope="col"><?=$recurrence_count?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>