$(document).ready(function () {

    $(".view_stock").click(function (e) { 
        e.preventDefault();
        
        var view= $(this).attr("type");
        var start= $('.start_date').val();
        var end= $('.end_date').val();
        var status= $('.status').val();
        
        if(view!=''&&start!=''&&end!=''){

            if(Date.parse(start) > Date.parse(end)){
                alert("Invalid Date Range");
             }
             else{

                $.ajax({
                    type: 'post',
                    url: 'stock_data.php',
                    datatype: "json",
                    data: {view:view,start:start,end:end,status:status},
                    success: function (response) 
                    {
                        $("#stock_date").html(response);
                        $(".download_stock").removeClass("d-none");
                    }
                });

            }

        }

    });

    $(".view_report").click(function (e) { 
        e.preventDefault();
        
        var show= $(this).attr("type");
        var start= $('.start_date').val();
        var end= $('.end_date').val();
        var status= $('.status').val();
        
        if(show!=''&&start!=''&&end!=''){

            if(Date.parse(start) > Date.parse(end)){
                alert("Invalid Date Range");
             }
             else{

                $.ajax({
                    type: 'post',
                    url: 'stock_data.php',
                    datatype: "json",
                    data: {show:show,start:start,end:end,status:status},
                    success: function (response) 
                    {
                        $("#report_date").html(response);
                        $(".download_report").removeClass("d-none");
                    }
                });

            }

        }

    });

    $("#coupon_type").change(function (e) { 
        e.preventDefault();
        coupon_type = $(this).val();

        if(coupon_type=='amount' || coupon_type=='percent'){
            $("#amount_unit").removeClass("d-none");
            $("#amount_unit").attr("required", true); 
            $("#product_unit").addClass("d-none");
            $("#product_unit").attr("required", false);   
        }

        if(coupon_type=='product'){
            $("#product_unit").removeClass("d-none");
            $("#product_unit").attr("required", true);
            $("#amount_unit").addClass("d-none");
            $("#amount_unit").attr("required", false);   
        }

    });

    $('#coupon_start_date').change(function (e) { 
        e.preventDefault();
        cou_start_date = $(this).val();
        
        $('#coupon_expiry_date').attr("min", cou_start_date);
        $('#coupon_expiry_date').val("");
    });

    $('#coupon_code').change(function (e) { 
        e.preventDefault();
        coupon_duli = $(this).val();
        $.ajax({
            type: "post",
            url: "ajax_coupon.php",
            data: {coupon_duli:coupon_duli},
            dataType: "json",
            success: function (response) {
                if(response==1){
                    $('#coupon_code').val("");
                    $('#coupon_duli').removeClass("d-none");
                }else{
                    $('#coupon_duli').addClass("d-none");
                }
            }
        });
    });

    $('#purchase_order_all').change(function (e) { 
        e.preventDefault();
        if ($(this).prop('checked')) {
            $("input[name='purchase_inc[]']").prop('checked', true);
            $("input[name='purchase_inc[]']").prop('disabled', true);
          } else {
            $("input[name='purchase_inc[]']").prop('checked', false);
            $("input[name='purchase_inc[]']").prop('disabled', false);
          }
    });
});