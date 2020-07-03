$(document).ready(function () {

    $('#city').change(function (e) {
        e.preventDefault();

        var cityVal = $(this).val();

        if(cityVal!='')
        {
            $.ajax({
                type: 'get',
                url: 'get_area.php',
                datatype: "json",
                data: {cityVal:cityVal},
                success: function (response) 
                {
                    $("#area").html(response);

                    }

                
            });

        }
        
    });

    $('#area').change(function (e) {
        e.preventDefault();

        var areaVal = $(this).val();

        if(areaVal!='')
        {
            $.ajax({
                type: 'get',
                url: 'get_area.php',
                datatype: "json",
                data: {areaVal:areaVal},
                success: function (response) 
                {
                    $("#landmark").html(response);
                }
            });

        }
        
    });
});