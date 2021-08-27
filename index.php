<?php 

include_once("config.php");
$events_data = getEvents(array('status' => 1));

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Events List | Tatvasoft Pratical Test</title>
        <link href="css/boostrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-4">
                    <div class="row">
                        <div class="col-10">
                            <h2>Event List</h2>
                        </div>
                        <div class="col-2">
                            <a href="add_edit_form.php" class="btn btn-primary float-end">Add</a>
                        </div>
                    </div>
                    <hr/>
                    <?php if(count($events_data)){ ?>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th class="align-middle" scope="col">#</th>
                                <th class="align-middle" scope="col">Title</th>
                                <th class="align-middle" scope="col">Dates</th>
                                <th class="align-middle" scope="col">Occurrence</th>
                                <th class="align-middle text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($events_data as $key => $row){ ?>
                            <tr>
                                <th class="align-middle" scope="row"><?=$key+1?></th>
                                <td class="align-middle"><?= $row['name'] ?></td>
                                <td class="align-middle"><?= $row['start_date'] ." to ". $row['end_date'] ?></td>
                                <td class="align-middle">
                                    <?php switch($row['recurrence_type']){
                                        case 'recurrence_type_1':
                                            echo RECURRENCE_TYPE_ONE_REPEAT_TYPE[$row['repeat_type']]." ".RECURRENCE_TYPE_ONE_REPEAT_EVERY[$row['repeat_every']];
                                        break;
                                        case 'recurrence_type_2':
                                            $month = "";
                                            if((int)$row['repeat_month'] == 12){
                                                $month = "of the Year";
                                            }elseif((int)$row['repeat_month'] == 1){
                                                $month = "of the Month";
                                            }else{
                                                $month = "of every ".(int)$row['repeat_month']." Months";
                                            }
                                            echo "Every ".RECURRENCE_TYPE_TWO_REPEAT_ON[$row['repeat_on']]." ".ucwords($row['repeat_week'])." ".$month;
                                        break;
                                    } ?>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="view.php?eid=<?=$row['id']?>" class="btn btn-info">View</a>
                                    <a href="add_edit_form.php?eid=<?=$row['id']?>" class="btn btn-secondary">Edit</a>
                                    <a href="delete.php?eid=<?=$row['id']?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php }else{ ?>
                    <div class="alert alert-danger" role="alert">Event Not Found</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>