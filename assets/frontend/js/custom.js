$(document).ready(function(){
    console.log('hi');
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
    
    $('#email_input').blur(function(){
        var check = $("#email_error").hasClass("alert-danger");
        if(check){
            $('#email_error').removeClass('alert-danger');
            $('#email_error').html('');
        }
        var email = $(this).val();
        email = email.trim();
        $.ajax({
            url: "ajax/check_email.php",
            type: "POST",
            data: {user_email:email},
            success: function(data){
                console.log(data);
                if (data == 1){
                    $('#email_error').addClass('alert-danger').html('Sorry Email Is Exists!!');
                }
            }
        });
    });

    // Update Admin Type 
    var test = $('#admin_type');
    console.log(test);
});