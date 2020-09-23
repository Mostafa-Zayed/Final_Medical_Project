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
    });

    // update Active 
    $('select#active').change(function(){
        var select_id = $(this).attr('data-id');
        var tr_id = $(this).parents('tr').attr('data-id');
        var models = $(this).parents('tr').attr('data-mod');
        if (select_id == tr_id) {
            var btn = $('#btn_active'+select_id).css('display','block');
            btn.click(function(){
                var active = btn.siblings('select').val();
                models = models.trim();
                $.ajax({
                    url: "../../ajax/update_active.php",
                    type: "POST",
                    data: {models:models,active:active,id:select_id},
                    success: function(data){
                        $('#message').html(data);
                    }
                });
                
            });
        }
    });
        
});