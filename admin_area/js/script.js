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

});