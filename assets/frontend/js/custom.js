$(document).ready(function(){
    $('#services').change(function(){
        //console.log('country selected');
         var serviceId = $(this).val();
        // console.log(serviceId);
         
        $.ajax({
            url: "ajax/check_service.php",
            type: "POST",
            data: {service_id:serviceId},
            success: function($data){
                if ($data == 1) {
                    var doctor = $('#doct');
                    doctor.fadeIn('slow');
                }
                
                //console.log($data);
            }
        });
    });
    $('#countries').change(function(){
        //console.log('country selected');
         var countryId = $(this).val();
        $.ajax({
            url: "ajax/load_states.php",
            type: "POST",
            data: {country_id:countryId},
            success: function($data){
                $('#states').html($data);
                //console.log($data);
            }
        });
    });
    
    $('#states').change(function(){
         var stateId = $(this).val();
        $.ajax({
            url: "ajax/load_cities.php",
            type: "POST",
            data: {state_id:stateId},
            success: function($data){
                $('#cities').html($data);
                //console.log($data);
            }
        });
    });
    

});