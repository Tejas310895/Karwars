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

    function register_referal(){
        if($("#fmr_check").is(":checked")){
            $("#customer_register").addClass("d-none");
        }else{
            $("#customer_register").removeClass("d-none");
        }
    }

    $("#fmr_check").click(function () { 
        referal_code();
    });

    $("#fmr_check").click(function () { 
        register_referal();
    });

    $("#fmr_code_input").keyup(function (e) { 
        e.preventDefault();
        var fmr_code_input = $("#fmr_code_input").val();

        $.ajax({
            type: "post",
            url: "./process_product.php",
            data: {"fmr_code_input":fmr_code_input},
            success: function (data) {
                if(data==1){
                    $("#check_fmr_code").removeClass("text-danger");
                    $("#check_fmr_code").addClass("text-success");
                    $("#customer_register").removeClass("d-none");
                    $("#check_fmr_code").html("<i class='fas fa-check'></i>");
                }else{
                    $("#check_fmr_code").removeClass("text-success");
                    $("#check_fmr_code").addClass("text-danger");
                    $("#check_fmr_code").html("<i class='fas fa-times'></i>");
                    $("#customer_register").addClass("d-none");
                }
            }
        });
    });

    $("#get_details").click(function (e) { 
        e.preventDefault();
        var fmr_code = $("#fmr_code").val();
        $.ajax({
            type: "post",
            url: "./fmr/get_details.php",
            data: {"fmr_code":fmr_code},
            success: function (response) {
                $("#fmr_details").html(response);
                alert(data);
            }
        });
    });

});