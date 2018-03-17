$(function() {
    $(".defaultCheck1").change(function() {

        if(this.checked) {
            // var val = this.defaultValue;
            $('form[name="complete_task"]').submit();

        }
    });
});


