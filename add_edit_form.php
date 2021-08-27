<?php 

include_once("config.php");
$page_title = "Add New Event";
$event_data = array();
if(isset($_GET['eid']) && (int)$_GET['eid'] > 0){
    $event_data = getEvents(array('eid' => (int)$_GET['eid']));
    $event_data = $event_data[0];
    $page_title = "Edit Event #".(int)$_GET['eid'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$page_title?> | Tatvasoft Pratical Test</title>
        <link href="css/boostrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-4">
                    <h2><?=$page_title?></h2>
                    <hr/>
                    <form class="form-horizantal" action="form_submit.php" method="POST" id="event_add_edit_form">
                        <input type="hidden" name="submit_action" value="event_add_edit">
                        <input type="hidden" name="eid" value="<?= count($event_data) ? (int)$_GET['eid'] : 0 ?>">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-end">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="<?= isset($event_data['name']) ? $event_data['name'] : "" ?>">
                                <div class="invalid-feedback" id="invalid_name"><?= !empty($_SESSION['errors']['invalid_name']) ? $_SESSION['errors']['invalid_name'] : '' ?></div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="start_date" class="col-sm-2 col-form-label text-end">Start Date:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="start_date" id="start_date" value="<?= isset($event_data['start_date']) ? $event_data['start_date'] : "" ?>">
                                <div class="invalid-feedback" id="invalid_start_date"><?= !empty($_SESSION['errors']['invalid_start_date']) ? $_SESSION['errors']['invalid_start_date'] : '' ?></div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="end_date" class="col-sm-2 col-form-label text-end">End Date:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="end_date" id="end_date" value="<?= isset($event_data['end_date']) ? $event_data['end_date'] : "" ?>">
                                <div class="invalid-feedback" id="invalid_end_date"><?= !empty($_SESSION['errors']['invalid_end_date']) ? $_SESSION['errors']['invalid_end_date'] : '' ?></div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="end_date" class="col-sm-2 col-form-label text-end">Recurrence:</label>
                            <div class="col-sm-10">
                                <?php foreach(RECURRENCE_TYPES as $type_key => $type_value){
                                    switch($type_key){
                                        case 'recurrence_type_1': ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="recurrence_type" id="<?=$type_key?>" value="<?=$type_key?>" <?= isset($event_data['recurrence_type']) && $event_data['recurrence_type'] == $type_key ? "checked" : "" ?>>
                                            <label class="form-check-label" for="<?=$type_key?>"><?=$type_value?></label>
                                            <select class="form-control mt-2 mb-2" name="<?=$type_key?>_repeat_type" id="<?=$type_key?>_repeat_type">
                                                <?php foreach(RECURRENCE_TYPE_ONE_REPEAT_TYPE as $repeat_type_key => $repeat_type_value){ ?>
                                                <option value="<?=$repeat_type_key?>" <?= isset($event_data['repeat_type']) && $event_data['repeat_type'] == $repeat_type_key ? 'selected' : '' ?>><?=$repeat_type_value?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="form-control mt-2 mb-2" name="<?=$type_key?>_repeat_every" id="<?=$type_key?>_repeat_every">
                                                <?php foreach(RECURRENCE_TYPE_ONE_REPEAT_EVERY as $repeat_every_key => $repeat_every_value){ ?>
                                                <option value="<?=$repeat_every_key?>" <?= isset($event_data['repeat_every']) && $event_data['repeat_every'] == $repeat_every_key ? 'selected' : '' ?>><?=$repeat_every_value?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php break;
                                        case 'recurrence_type_2': ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="recurrence_type" id="<?=$type_key?>" value="<?=$type_key?>" <?= isset($event_data['recurrence_type']) && $event_data['recurrence_type'] == $type_key ? "checked" : "" ?>>
                                            <label class="form-check-label" for="<?=$type_key?>"><?=$type_value?></label>
                                            <select class="form-control mt-2 mb-2" name="<?=$type_key?>_repeat_on" id="<?=$type_key?>_repeat_on">
                                                <?php foreach(RECURRENCE_TYPE_TWO_REPEAT_ON as $repeat_on_key => $repeat_on_value){ ?>
                                                <option value="<?=$repeat_on_key?>" <?= isset($event_data['repeat_on']) && $event_data['repeat_on'] == $repeat_on_key ? 'selected' : '' ?>><?=$repeat_on_value?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="form-control mt-2 mb-2" name="<?=$type_key?>_repeat_week" id="<?=$type_key?>_repeat_week">
                                                <?php foreach(RECURRENCE_TYPE_TWO_REPEAT_WEEK as $repeat_week_key => $repeat_week_value){ ?>
                                                <option value="<?=$repeat_week_key?>" <?= isset($event_data['repeat_week']) && $event_data['repeat_week'] == $repeat_week_key ? 'selected' : '' ?>><?=$repeat_week_value?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="form-control mt-2 mb-2" name="<?=$type_key?>_repeat_month" id="<?=$type_key?>_repeat_month">
                                                <?php foreach(RECURRENCE_TYPE_TWO_REPEAT_MONTH as $repeat_month_key => $repeat_month_value){ ?>
                                                <option value="<?=$repeat_month_key?>" <?= isset($event_data['repeat_month']) && $event_data['repeat_month'] == $repeat_month_key ? 'selected' : '' ?>><?=$repeat_month_value?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php break;
                                        default:
                                            echo "Implementation is pending";
                                        break;
                                    }
                                } ?>
                                <div class="invalid-feedback" id="invalid_recurrence_type"><?= !empty($_SESSION['errors']['invalid_recurrence_type']) ? $_SESSION['errors']['invalid_recurrence_type'] : '' ?></div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary" onclick="validate_event_form(this);">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="js/jquery.min.js"></script>
    <script src="js/common.js"></script>
    <?php unset($_SESSION['errors']); ?>
</html>