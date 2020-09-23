$(document).ready(function(){

    // Update Admin Type 
    $('select#admin_type').change(function(){
        var select_id = $(this).attr('data-id');
        var tr_id = $(this).parents('tr').attr('data-id');
        if (select_id == tr_id) {
            $('#admin_update'+select_id).css('display','block');  
            $('#admin_update'+select_id).click(function(){
                var type = $(this).siblings('select').val();
                type = type.trim();
                if (type != '') {
                    $.ajax({
                        url: "../../ajax/update_admin_type.php",
                        type: "POST",
                        data: {admin_id: select_id , admin_type:type},
                        success: function(data){
                            $('#message').css('display','block');
                            $('#message').html(data);
                        }
                    })
                }
            });
        }
        //$('#admin_update').click(function(){
          //  var admin_id = $('#admin_type').parents('tr').attr('id');
            //console.log(admin_id);
            /*var type = $('#admin_type').val();
            type = type.trim();
            if (type != '') {
                $.ajax({
                    url: "../../ajax/update_admin_type.php",
                    type: "POST",
                    data: {admin_type:type},
                    success: function(data){
                        console.log(data);
                    }
                })
            }*/
        //})
        
    });
});