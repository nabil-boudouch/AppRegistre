// JavaScript Document

$(document).ready(function(e) {
	
	
	var i = 1;
	
	$('#gestion_passbundle_facilitationtype').find('div').each(function(index, element) {
        $(this).addClass('elementForm_'+i);
		i++;
    });

});