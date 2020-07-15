$(document).ready(function () {

    $(".view_stock").click(function (e) { 
        e.preventDefault();
        
        var view= $(this).attr("type");
        var start= $('.start_date').val();
        var end= $('.end_date').val();
        
        if(view!=''&&start!=''&&end!=''){

            if(Date.parse(start) > Date.parse(end)){
                alert("Invalid Date Range");
             }
             else{

                $.ajax({
                    type: 'post',
                    url: 'stock_data.php',
                    datatype: "json",
                    data: {view:view,start:start,end:end},
                    success: function (response) 
                    {
                        $("#stock_date").html(response);
                        $(".download_stock").removeClass("d-none");
                    }
                });

            }

        }

    });

});