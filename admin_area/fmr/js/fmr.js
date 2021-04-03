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

    $(document).on('click', '#send_otp', function () {
        var send_otp = $("#c_contact").val();

        if(send_otp.length<10){
            alert('Enter mobile number properly');
        }else{
        $.ajax({
            type: "post",
            url: "./otp_verification.php",
            data: {"send_otp":send_otp},
            success: function (data) {
                if(data==1){
                $('#otp_input').removeClass('d-none');
                $('#send_otp').addClass('d-none');
                $('#change_no').removeClass('d-none');
                $('#c_contact').attr('readonly' , true);
                }if(data==2){
                    alert('Number Already Registered Please login');
                }
            }
        });
    }
    });
    $(document).on('click', '#otp_verify', function () {
        var otp_verify = $("#c_otp").val();

        if(otp_verify.length<4){
            alert('Enter Invalid');
        }else{
        $.ajax({
            type: "post",
            url: "./otp_verification.php",
            data: {"otp_verify":otp_verify},
            success: function (data) {
                if(data==1){
                $('#otp_input').addClass('d-none');
                $('#send_otp').addClass('d-none');
                $('#c_contact').attr('readonly' , true);
                }else{
                    alert('Wrong Otp, Try Again');
                }
            }
        });
    }
    });
    $(document).on('change', '#c_email', function () {
        var cust_email = $(this).val();

        $.ajax({
            type: "post",
            url: "./otp_verification.php",
            data: {"cust_email":cust_email},
            success: function (data) {
                if(data==1){
                    $('.email_alert').removeClass('d-none');
                    $('#c_email').val('');
                }else{
                    $('.email_alert').addClass('d-none');
                }
            }
        });
    });
    $(document).on('click', '#change_no', function () {
        $('#otp_input').addClass('d-none');
        $('#change_no').addClass('d-none');
        $('#send_otp').removeClass('d-none');
        $('#c_contact').attr('readonly' , false);
    });

/* customer login */
    $(document).on('click', '#send_log_otp', function () {
        var send_log_otp = $("#c_log_contact").val();

        if(send_log_otp.length<10){
            alert('Enter mobile number properly');
        }else{
        $.ajax({
            type: "post",
            url: "./otp_verification.php",
            data: {"send_log_otp":send_log_otp},
            success: function (data) {
                if(data==1){
                $('#otp_log_input').removeClass('d-none');
                $('#send_log_otp').addClass('d-none');
                $('#change_log_no').removeClass('d-none');
                $('#c_log_contact').attr('readonly' , true);
                }if(data==2){
                    alert('Number not Registered Please register');
                }
            }
        });
    }
    });
    $(document).on('click', '#otp_log_verify', function () {
        var otp_log_verify = $("#c_log_otp").val();
        var c_log_verify = $("#c_log_contact").val();

        if(otp_log_verify.length<4){
            alert('Enter Invalid');
        }else{
        $.ajax({
            type: "post",
            url: "./otp_verification.php",
            dataType: "json",
            data: {"otp_log_verify":otp_log_verify,
                   "c_log_verify":c_log_verify},
            success: function (data) {
                if(data==1){
                alert('your are Logged in ');
                window.location.href = './';
                $('#otp_log_input').addClass('d-none');
                $('#send_log_otp').addClass('d-none');
                $('#c_log_contact').attr('readonly' , true);
                }else{
                    alert('Wrong Otp, Try Again');
                }
            }
        });
    }
    });
    $(document).on('click', '#change_log_no', function () {
        $('#otp_log_input').addClass('d-none');
        $('#change_log_no').addClass('d-none');
        $('#send_log_otp').removeClass('d-none');
        $('#c_log_contact').attr('readonly' , false);
    });
/* customer login */
});
