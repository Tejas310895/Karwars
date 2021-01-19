$(document).ready(function () {
    $("#generate_fmr_id").click(function (e) { 
        e.preventDefault();
        var last_id = $("#last_id").val();
        var fmr_name = $("#fmr_name").val().substr(0, 2).toUpperCase();
        var fmr_dob = $("#fmr_dob").val().substr(8, 2);

        var value = 'FMR'+fmr_name+fmr_dob+last_id;

        $("#get_fmr_id").val(value);
    });

    //group add limit
    var maxGroup = 10;

    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });

    function referal_code(){
        if($("#fmr_check").is(":checked")) {
            $("#fmr_code").removeClass("d-none");
            $("#fmr_code").attr('required', true);
        }else{
            $("#fmr_code").addClass("d-none");
            $("#fmr_code").removeAttr('required');
        }

    }

    $("#fmr_check").click(function () { 
        referal_code();
    });
});