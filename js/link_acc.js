$(function(){
    $('#link_add').submit(function(){
        var url = '/ajax.php?action=links&type='+$("#type").val();//$(this).attr('action');
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
	
	
});


