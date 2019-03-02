/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addEventForm = $("#addEvent");
	
	var validator = addEventForm.validate({
		
		rules:{
			noParticipants:{ required : true },
			tittleEvent : { required : true },
			dateActual : { required : true },
			dateEnd : {required : true},
			timeActual : { required : true},
			timeEnd : { required : true},
			purpose : { required : true},
			contactNo : { required : true},
			venue : { required : true},
			department : { required : true},
			equipment : { required : true},
			tableNo : { required : true},
			chairNo : { required : true}
		},
		messages:{
			noParticipants :{ required : "This field is required" },
			tittleEvent : { required : "This field is required" },
			dateActual :{ required : "This field is required" },
			dateEnd : { required : "This field is required" },
			timeActual :{ required : "This field is required" },
			timeEnd : { required : "This field is required" },
			purpose :{ required : "This field is required" },
			contactNo : { required : "This field is required" },
			venue :{ required : "This field is required" },
			department : { required : "This field is required" },
			equipment :{ required : "This field is required" },
			tableNo : { required : "This field is required" },
			chairNo :{ required : "This field is required" },
		}
	});
});
