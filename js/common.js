function validate_event_form(self){
    $('.invalid-feedback').hide();
    var name = $.trim($('#name').val());
    if(name == ''){
        $('#invalid_name').html('Please Enter Title').show();
        return false;
    }
    var start_date = $.trim($('#start_date').val());
    if(start_date == ''){
        $('#invalid_start_date').html('Please Enter Start Date').show();
        return false;
    }
    var end_date = $.trim($('#end_date').val());
    if(end_date == ''){
        $('#invalid_end_date').html('Please Enter End Date').show();
        return false;
    }
    var fdate = new Date(start_date),
    tdate = new Date(end_date);
    if (fdate.valueOf() > tdate.valueOf()) {
        $('#invalid_start_date').html('Start Date should not greater than End Date').show();
        return false;
    }
    var recurrence_type = $.trim($('input[type="radio"][name="recurrence_type"]:checked').val());
    if(recurrence_type == ''){
        $('#invalid_recurrence_type').html('Please Choose Recurrence Type').show();
        return false;
    }
    $('#event_add_edit_form').submit();
}