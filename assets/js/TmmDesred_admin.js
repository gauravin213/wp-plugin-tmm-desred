/*
*
*/
jQuery(document).ready(function($){

	//jQuery( "input[name='date_of_birth']" ).datepicker({dateFormat: 'dd-mm-yy', timeFormat: 'hh:mm ss'});

	//jQuery( "input[name='date_of_retirement']" ).datepicker({dateFormat: 'dd-mm-yy', timeFormat: 'hh:mm ss'});

	//jQuery( "input[name='year']" ).datepicker({dateFormat: 'dd-mm-yy', timeFormat: 'hh:mm ss'});

	//
		jQuery("input[name='date_of_birth']").datepicker({
			changeMonth: true,
      		changeYear: true,
		    dateFormat: 'dd/mm/yy',
		    onSelect: function(dateStr) {
		        var d = jQuery.datepicker.parseDate('dd/mm/yy', dateStr);
		        var years = parseInt(60, 10);

		        d.setFullYear(d.getFullYear() + years);

		        jQuery("input[name='date_of_retirement']").datepicker('setDate', d);
		        
		    }
		});
		jQuery("input[name='date_of_retirement']").datepicker({
			changeMonth: true,
      		changeYear: true,
		    dateFormat: 'dd/mm/yy'
		});
		//


	jQuery( "input[name='year']" ).datepicker({
      changeMonth: true,
      changeYear: true
    });

    jQuery( "input[name='date_of_joining']" ).datepicker({
      changeMonth: true,
      changeYear: true
    });

     jQuery( "input[name='date_of_blood_donation']" ).datepicker({
      changeMonth: true,
      changeYear: true
    });

    /* jQuery( "input[name='date_of_birth']" ).datepicker({
      changeMonth: true,
      changeYear: true
    });*/

     /*jQuery( "input[name='date_of_retirement']" ).datepicker({
      changeMonth: true,
      changeYear: true
    });*/

	/*jQuery("input[name='year']").datepicker( { 
        changeMonth: false,
        changeYear: true,
        showButtonPanel: true,
        //yearRange: '1950:2013', // Optional Year Range
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = jQuery("#ui-datepicker-div .ui-datepicker-year :selected").val();
            jQuery(this).datepicker('setDate', new Date(year, 0, 1));
        }
    });*/

    jQuery("input[name='date_of_birth']").attr('autocomplete', 'off');
    jQuery("input[name='date_of_joining']").attr('autocomplete', 'off');
    jQuery("input[name='date_of_retirement']").attr('autocomplete', 'off');
    jQuery("input[name='year']").attr('autocomplete', 'off');
    jQuery("input[name='date_of_blood_donation']").attr('autocomplete', 'off');

	jQuery("#form_tmm_desred_members").validate({
		rules: {
			name: {
				required: true,
			},
			lm_number: {
				required: true,
				digits: true
			},
			siniority_list_number: {
				required: true,
				digits: true
			},
			address: {
				required: true,
			},
			city: {
				required: true,
			},
			assistant_engineers: {
				required: true,
			},
			father_or_husband_name: {
				required: true,
			},
			date_of_birth: {
				required: true,
			},
			district: {
				required: true,
			},
			circle: {
				required: true,
			},
			cast: {
				required: true,
			},
			dy_cast: {
				required: true,
			},
			date_of_retirement: {
				required: true,
			},
			appointment_letter_number_and_date: {
				required: true,
			},
			mobile_number: {
				required:true,
				minlength:10,
				maxlength:10,
				number: true

			},
			whatsApp_number: {
				required:true,
				minlength:10,
				maxlength:10,
				number: true
			},
			email: {
				required: true,
				email: true
			}
		}/*,
		messages: {
			name: {
				required: 'Enter this!'
			}
		}*/
	});

	jQuery("#form_tmm_desred_sangh").validate({
		rules: {
			member_id: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			},
			year: {
				required: true,
			}
		}
	});

	jQuery("#form_tmm_desred_mahasangh").validate({
		rules: {
			member_id: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			},
			year: {
				required: true,
			}
		}
	});

	jQuery("#form_tmm_desred_family_welfare_scheme").validate({
		rules: {
			member_id: {
				required: true,
			},
			level: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			}
		}
	});


	jQuery("#form_tmm_desred_family_welfare_scheme_mahasangh").validate({
		rules: {
			lm_number: {
				required: true,
			},
			level: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			},
			card_number: {
				required: true,
			}
		}
	});

	jQuery("#form_tmm_desred_anshdan").validate({
		rules: {
			member_id: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			},
			year: {
				required: true,
			}
		}
	});

	jQuery("#form_tmm_desred_building_fund").validate({
		rules: {
			member_id: {
				required: true,
			},
			amount: {
				required: true,
				digits: true
			},
			p_no: {
				required: true,
			},
			grad: {
				required: true,
			}
		}
	});

	jQuery("#form_tmm_desred_maha_adhiveshan").validate({
		rules: {
			member_id: {
				required: true,
			},
			fee_amount: {
				required: true,
				digits: true
			},
			reg_acount: {
				required: true,
				digits: true
			}
		}
	});


	jQuery("#form_tmm_desred_expenses_add_option").validate({
		rules: {
			member_id: {
				required: true,
			},
			department: {
				required: true,
			},
			causes: {
				required: true,
			}
		}
	});

});