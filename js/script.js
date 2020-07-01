    $(document).ready(function () {
    
        $('.add').click(function (e) { 
            e.preventDefault();
    
            var add_id= $(this).attr("id");
    
            if(add_id!='')
            {
                $.ajax({
                    type: 'post',
                    url: 'process_product.php',
                    datatype: "json",
                    data: {add_id:add_id},
                    success: function (response) 
                    {
                        $.globalEval(response);
                    }
                });
            }
            
        });
    
        $('.del').click(function (e) { 
            e.preventDefault();
    
            var del_id= $(this).attr("id");
    
            if(del_id!='')
            {
                $.ajax({
                    type: 'post',
                    url: 'process_product.php',
                    datatype: "json",
                    data: {del_id:del_id},
                    success: function (response) 
                    {
                        location.reload(false);
                    }
                });
            }
            
        });

        $('.search').keyup(function (e) {
            e.preventDefault();
    
            var searchVal = $(this).val();
    
            if(searchVal!='')
            {
                $.ajax({
                    type: 'get',
                    url: 'search_result.php',
                    datatype: "json",
                    data: {searchVal:searchVal},
                    success: function (response) 
                    {
                        $("#display").html(response);
                    }
                });
            }
            
        });

        $(window).on('popstate', function() {
            location.reload(true);
         });
    
    });