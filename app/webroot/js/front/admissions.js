var required_class = 'required';
jQuery(function() {
	jQuery(".datepicker").datepicker({
		changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
    });
    jQuery("#birth_date_input").change(function() {
    	var birth_date = jQuery(this).val();
    	jQuery('#pupil_details5').val(birth_date);    	
	});
	jQuery("#pupil_details5").change(function() {
    	var birth_date = jQuery(this).val();
    	jQuery('#birth_date_input').val(birth_date);    	
	});
    jQuery("form :input.take_placeholder").each(function(index, elem) {
    	var eId = jQuery(elem).attr("id");
    	var label = null;
    	if (eId && (label = jQuery(elem).parents("form").find("label[for="+eId+"]")).length == 1) {
    		var label_data = jQuery(label).html().replace(":", ""); 
    		jQuery(elem).attr("placeholder", label_data);
		}
	});
	jQuery("form#admissionsform").submit(function(event){
		event.preventDefault();
        validate_admissions_form();
    });
    jQuery("input.required_input, select.required_input").on("change paste keyup", function() {
		validate_required_input(jQuery(this));
	});
	jQuery(':file').change(function(){
		validate_required_input_image(jQuery(this), this);
    });  
});
function validate_admissions_form(){
	var error_flag = 0;
	var focused = 0;
	jQuery('input.required_input, select.required_input').each(function(){
		validate_required_input(jQuery(this));
	});
	jQuery('input.required_input[type="checkbox"]').each(function(){
		validate_required_input_checkbox(jQuery(this).attr('id'));
	});
	jQuery('input.required_input[type="file"]').each(function(){
		validate_required_input_image(jQuery(this), this);
	});
	jQuery('input, select').each(function(){
		if(jQuery(this).hasClass(required_class)){ 
			error_flag = 1;
			if(focused == 0){
	    		focused = 1;
		    	jQuery(this).focus();
		    }
		}
	});
	/* var inputs_ids = ['child_name_input', 'birth_date_input', 
    			   'year_group_applied_for_input', 'requested_date_of_entry_to_the_school_input',
    			   'pupil_details1', 'pupil_details2', 'pupil_details3', 'pupil_details4',
    			   'pupil_details5', 'pupil_details6', 'pupil_details7', 'pupil_details8', 
    			   'pupil_details9', 'pupil_details10'
    			  ];
	var inputs_names = ['transportation'];  
    inputs_ids.forEach(function(entry){
	    if(jQuery("#"+entry).val().length === 0){
	    	error_flag = 1;
	    	jQuery("#"+entry).addClass(required_class);
	    	if(focused == 0){
	    		focused = 1;
		    	jQuery("#"+entry).focus();
		    }
	    }else{
	    	jQuery("#"+entry).removeClass(required_class);
	    }  
	});
	inputs_names.forEach(function(entry){
		//console.log(jQuery('input[name='+entry+']:checked').size());
		if(jQuery('input[name='+entry+']:checked').size() === 0){
			error_flag = 1;
	    	jQuery('input[name='+entry+']').addClass(required_class);
	    	if(focused == 0){
	    		focused = 1;
		    	jQuery('input[name='+entry+']').focus();
		    }
	    }else{
	    	jQuery('input[name='+entry+']').removeClass(required_class);
	    }  				  
	});*/
    if(error_flag === 0){                         
        send_addmission_form();                             
    }
}
function send_addmission_form () {
	var formData = new FormData($('form#admissionsform')[0]);
	jQuery.ajax({
		url: base_url+'/page/admissionsform/ajax',
    	type: 'POST',
    	//data: jQuery('form#admissionsform').serialize(),
    	data: formData,
	    async: false,
	    cache: false,
	    contentType: false,
	    processData: false,
	    beforeSend: function(){
	    	jQuery('#admissions_result').hide();
	        jQuery('#admissions_ajaxLoading').show(); 
	    },
	    success:function(result){
	    	jQuery('#admissions_ajaxLoading').hide();
	        jQuery('#admissions_result').html(result).show();
	        document.getElementById("admissionsform").reset();
	    }
	});
}
function validate_required_input(obj){
	var val = obj.val();
	if (jQuery.trim(val).length !== 0){
		if(obj.hasClass(required_class)){
			obj.removeClass(required_class);			
		}
	}else{
		if(!(obj.hasClass(required_class))){
			obj.addClass(required_class);			
		}			
	}
}
function validate_required_input_checkbox(obj){	
	var obj_in = jQuery('#'+obj);
	if(jQuery('#'+obj+':checked').length > 0){
		if(obj_in.hasClass(required_class)){
			obj_in.removeClass(required_class);			
		}
	}else{
		if(!(obj_in.hasClass(required_class))){
			obj_in.addClass(required_class);			
		}			
	}  
}
function validate_required_input_image(obj, objthis){
	var file = objthis.files[0];
	if (typeof file !== typeof undefined && file !== false) {
		var name = file.name;
    	var size = file.size;
    	var type = file.type;      
    	var ext = name.substr(name.lastIndexOf('.') + 1);  
    	var ext = ext.toLowerCase();
    	if(ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'jpg'){
    		obj.removeClass(required_class);
		}else{
			obj.addClass(required_class);
		}  
	}else{
		obj.addClass(required_class);
    }
}