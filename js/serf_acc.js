$(function(){
    $('#serf_add').submit(function(){
        var url = '/ajax.php?action=serf&type='+$("#type").val();//$(this).attr('action');
        var data = $(this).serialize()+'&ajax=1';
        $.post(url, data, function(result){
            if(result['id'] != ''){
                $('#'+result['id']).addClass('is-invalid');
            }
            swal(result['title'], result['error'], result['status']);
            if(result['status'] == 'success'){
                if(result['redirect'] != ''){
                    setTimeout(function(){
                        window.location.replace(result['redirect']);
                    }, 1000);
                }
            } 
        }, 'json');
        return false;
    });
	
	$('.balance_add').submit(function(){
        var url = '/ajax.php?action=serf&type='+$("#type").val();//$(this).attr('action');
        var balance = $('#balance').html();
        var data = $(this).serialize()+'&balance='+balance+'&ajax=1';
        $.post(url, data, function(result){
            if(result['id'] != ''){
                $('#'+result['id']).addClass('is-invalid');
            }
            swal(result['title'], result['error'], result['status']);
            if(result['status'] == 'success'){
                if(result['redirect'] != ''){
                    setTimeout(function(){
                        window.location.replace(result['redirect']);
                    }, 1000);
                }
            } 
        }, 'json');
        return false;
    });
	
	$('#serf_edit').submit(function(){
        var url = '/ajax.php?action=serf&type='+$("#type").val();//$(this).attr('action');
        var data = $(this).serialize()+'&ajax=1';
        $.post(url, data, function(result){
            if(result['id'] != ''){
                $('#'+result['id']).addClass('is-invalid');
            }
            swal(result['title'], result['error'], result['status']);
            if(result['status'] == 'success'){
                if(result['redirect'] != ''){
                    setTimeout(function(){
                        window.location.replace(result['redirect']);
                    }, 1000);
                }
            } 
        }, 'json');
        return false;
    });
	
	 $(document).on('click', '.status_serf',function() {
        var button = $(this);
        var serf_id = button.attr('serf_id');
        var status = button.attr('action');
        $.post('/ajax.php?action=serf&type=status', {'serf_id': serf_id,'status':status}, function(result) {
            if(result['status'] == 'success'){
                if(status === 'active'){
                    button.attr('action','deactive');
                    button.html('<i class="fa fa-pause"></i> Остановить');
                    button.removeClass('text-success');
                    button.addClass('text-warning');
                }else if(status === 'deactive'){
                    button.attr('action','active');
                    button.html('<i class="fa fa-play"></i> Запустить');
                    button.removeClass('text-warning');
                    button.addClass('text-success');
                }  
            }
        }, 'json');
        return false;
    });
	
	$(document).on('click', '.delete',function() {
        var serf_id = $(this).attr('serf_id');
        $.post('/ajax.php?action=serf&type=delete', {'serf_id': serf_id}, function(result) {
            swal(result['title'], result['error'], result['status']);
            if(result['status'] == 'success'){
                $('#serf_'+serf_id).remove();
            }
        }, 'json');
        return false;
    });
	
});


