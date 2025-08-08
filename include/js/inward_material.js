var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;

function GetLocation() {
    var location_type = "";
    if(jQuery('select[name="location_type"]').length > 0) {
        location_type = jQuery('select[name="location_type"]').val().trim();
    }
    if(jQuery('select[name="godown_type"]').length > 0) {
        jQuery('select[name="godown_type"]').val('').trigger('change');
    }
    if(jQuery('select[name="selected_godown_id"]').length > 0) {
        jQuery('select[name="selected_godown_id"]').val('').trigger('change');
    }
    if(parseInt(location_type) == 1) {
        if(jQuery('#godown_type_div').length > 0) {
            jQuery('#godown_type_div').removeClass('d-none');
        }
        if(jQuery('#selected_godown_id_div').length > 0) {
            jQuery('#selected_godown_id_div').removeClass('d-none');
        }
        if(jQuery('#selected_factory_id_div').length > 0) {
            jQuery('#selected_factory_id_div').addClass('d-none');
        }
    }
    else if(parseInt(location_type) == 2) {
        if(jQuery('#godown_type_div').length > 0) {
            jQuery('#godown_type_div').addClass('d-none');
        }
        if(jQuery('#selected_factory_id_div').length > 0) {
            jQuery('#selected_factory_id_div').removeClass('d-none');
        }
        if(jQuery('#selected_godown_id_div').length > 0) {
            jQuery('#selected_godown_id_div').addClass('d-none');
        }
    }
    else {
        if(jQuery('#godown_type_div').length > 0) {
            jQuery('#godown_type_div').addClass('d-none');
        }
        if(jQuery('#selected_factory_id_div').length > 0) {
            jQuery('#selected_factory_id_div').addClass('d-none');
        }
        if(jQuery('#selected_godown_id_div').length > 0) {
            jQuery('#selected_godown_id_div').removeClass('d-none');
        }
    }
}
function AddProductRow(empty_row) {
    var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
                if (jQuery('.table-infos').length > 0) {
                    jQuery('.table-infos').html('');
                }
                if(jQuery('.add_product_button').length > 0) {
                    jQuery('.add_product_button').attr('disabled', true);
                }
                var error = ""; var all_errors_check = 1;
                var product_count = 0;
                if(jQuery('input[name="product_count"]').length > 0) {
                    product_count = jQuery('input[name="product_count"]').val().trim();
                    product_count = parseInt(product_count) + 1;
                }
                var location_type = "";
                if(jQuery('select[name="location_type"]').length > 0) {
                    location_type = jQuery('select[name="location_type"]').val().trim();
                    if(location_type == "" || location_type == null || typeof location_type == "undefined") {
                        all_errors_check = 0;
                        if(jQuery('select[name="location_type"]').parent().parent().parent().find('span.infos').length == 0) {
                            jQuery('select[name="location_type"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid Location</span>');
                        }
                    }
                    else {
                        if(jQuery('select[name="location_type"]').parent().parent().parent().find('span.infos').length > 0) {
                            jQuery('select[name="location_type"]').parent().parent().parent().find('span.infos').remove();
                        }
                    }
                }
                var godown_type = "";
                if(jQuery('select[name="godown_type"]').is(":visible")) {
                    if(jQuery('select[name="godown_type"]').length > 0) {
                        godown_type = jQuery('select[name="godown_type"]').val().trim();
                        if(godown_type == "" || godown_type == null || typeof godown_type == "undefined") {
                            all_errors_check = 0;
                            if(jQuery('select[name="godown_type"]').parent().parent().parent().find('span.infos').length == 0) {
                                jQuery('select[name="godown_type"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid Godown Type</span>');
                            }
                        }
                        else {
                            if(jQuery('select[name="godown_type"]').parent().parent().parent().find('span.infos').length > 0) {
                                jQuery('select[name="godown_type"]').parent().parent().parent().find('span.infos').remove();
                            }
                        }
                    }
                }
                var selected_godown_id = "";
                if(jQuery('select[name="selected_godown_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_godown_id"]').length > 0) {
                        selected_godown_id = jQuery('select[name="selected_godown_id"]').val().trim();
                        if(selected_godown_id == "" || selected_godown_id == null || typeof selected_godown_id == "undefined") {
                            if((parseInt(empty_row) == 1 && parseInt(godown_type) == 1) || empty_row == "") {
                                all_errors_check = 0;
                                if(jQuery('select[name="selected_godown_id"]').parent().parent().parent().find('span.infos').length == 0) {
                                    jQuery('select[name="selected_godown_id"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid Godown</span>');
                                }
                            }
                            else {
                                if(jQuery('select[name="selected_godown_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                    jQuery('select[name="selected_godown_id"]').parent().parent().parent().find('span.infos').remove();
                                }
                            }
                        }
                        else {
                            if(jQuery('select[name="selected_godown_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                jQuery('select[name="selected_godown_id"]').parent().parent().parent().find('span.infos').remove();
                            }
                        }
                    }
                }
                var selected_factory_id = "";
                if(jQuery('select[name="selected_factory_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_factory_id"]').length > 0) {
                        selected_factory_id = jQuery('select[name="selected_factory_id"]').val().trim();
                        if(selected_factory_id == "" || selected_factory_id == null || typeof selected_factory_id == "undefined") {
                            all_errors_check = 0;
                            if(jQuery('select[name="selected_factory_id"]').parent().parent().parent().find('span.infos').length == 0) {
                                jQuery('select[name="selected_factory_id"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid Factory</span>');
                            }
                        }
                        else {
                            if(jQuery('select[name="selected_factory_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                jQuery('select[name="selected_factory_id"]').parent().parent().parent().find('span.infos').remove();
                            }
                        }
                    }
                }
                var selected_size_id = ""; var selected_gsm_id = ""; var selected_bf_id = ""; var selected_quantity = "";
                if(empty_row == "") {
                    if(jQuery('select[name="selected_size_id"]').is(":visible")) {
                        if(jQuery('select[name="selected_size_id"]').length > 0) {
                            selected_size_id = jQuery('select[name="selected_size_id"]').val().trim();
                            if(selected_size_id == "" || selected_size_id == null || typeof selected_size_id == "undefined") {
                                all_errors_check = 0;
                                if(jQuery('select[name="selected_size_id"]').parent().parent().parent().find('span.infos').length == 0) {
                                    jQuery('select[name="selected_size_id"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid Size</span>');
                                }
                            }
                            else {
                                if(jQuery('select[name="selected_size_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                    jQuery('select[name="selected_size_id"]').parent().parent().parent().find('span.infos').remove();
                                }
                            }
                        }
                    }
                    else {
                        if(jQuery('input[name="selected_size_name"]').is(":visible")) {
                            if(jQuery('input[name="selected_size_name"]').length > 0) {
                                selected_size_id = jQuery('input[name="selected_size_name"]').val().trim();
                                if(selected_size_id == "" || selected_size_id == 0 || selected_size_id == null || typeof selected_size_id == "undefined" || price_regex.test(selected_size_id) == false) {
                                    all_errors_check = 0;
                                    if(jQuery('input[name="selected_size_name"]').parent().parent().parent().find('span.infos').length == 0) {
                                        jQuery('input[name="selected_size_name"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid Size</span>');
                                    }
                                }
                                else {
                                    if(jQuery('input[name="selected_size_name"]').parent().parent().parent().find('span.infos').length > 0) {
                                        jQuery('input[name="selected_size_name"]').parent().parent().parent().find('span.infos').remove();
                                    }
                                }
                            }
                        }
                    }
                    if(jQuery('select[name="selected_gsm_id"]').is(":visible")) {
                        if(jQuery('select[name="selected_gsm_id"]').length > 0) {
                            selected_gsm_id = jQuery('select[name="selected_gsm_id"]').val().trim();
                            if(selected_gsm_id == "" || selected_gsm_id == null || typeof selected_gsm_id == "undefined") {
                                all_errors_check = 0;
                                if(jQuery('select[name="selected_gsm_id"]').parent().parent().parent().find('span.infos').length == 0) {
                                    jQuery('select[name="selected_gsm_id"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid GSM</span>');
                                }
                            }
                            else {
                                if(jQuery('select[name="selected_gsm_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                    jQuery('select[name="selected_gsm_id"]').parent().parent().parent().find('span.infos').remove();
                                } 
                            }
                        }
                    }
                    else {
                        if(jQuery('input[name="selected_gsm_name"]').is(":visible")) {
                            if(jQuery('input[name="selected_gsm_name"]').length > 0) {
                                selected_gsm_id = jQuery('input[name="selected_gsm_name"]').val().trim();
                                if(selected_gsm_id == "" || selected_gsm_id == 0 || selected_gsm_id == null || typeof selected_gsm_id == "undefined" || number_regex.test(selected_gsm_id) == false) {
                                    all_errors_check = 0;
                                    if(jQuery('input[name="selected_gsm_name"]').parent().parent().parent().find('span.infos').length == 0) {
                                        jQuery('input[name="selected_gsm_name"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid GSM</span>');
                                    }
                                }
                                else {
                                    if(jQuery('input[name="selected_gsm_name"]').parent().parent().parent().find('span.infos').length > 0) {
                                        jQuery('input[name="selected_gsm_name"]').parent().parent().parent().find('span.infos').remove();
                                    }
                                }
                            }
                        }
                    }
                    if(jQuery('select[name="selected_bf_id"]').is(":visible")) {
                        if(jQuery('select[name="selected_bf_id"]').length > 0) {
                            selected_bf_id = jQuery('select[name="selected_bf_id"]').val().trim();
                            if(selected_bf_id == "" || selected_bf_id == null || typeof selected_bf_id == "undefined") {
                                all_errors_check = 0;
                                if(jQuery('select[name="selected_bf_id"]').parent().parent().parent().find('span.infos').length == 0) {
                                    jQuery('select[name="selected_bf_id"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Select a Valid BF</span>');
                                }
                            }
                            else {
                                if(jQuery('select[name="selected_bf_id"]').parent().parent().parent().find('span.infos').length > 0) {
                                    jQuery('select[name="selected_bf_id"]').parent().parent().parent().find('span.infos').remove();
                                }
                            }
                        }
                    }
                    else {
                        if(jQuery('input[name="selected_bf_name"]').is(":visible")) {
                            if(jQuery('input[name="selected_bf_name"]').length > 0) {
                                selected_bf_id = jQuery('input[name="selected_bf_name"]').val().trim();
                                if(selected_bf_id == "" || selected_bf_id == 0 || selected_bf_id == null || typeof selected_bf_id == "undefined" || price_regex.test(selected_bf_id) == false) {
                                    all_errors_check = 0;
                                    if(jQuery('input[name="selected_bf_name"]').parent().parent().parent().find('span.infos').length == 0) {
                                        jQuery('input[name="selected_bf_name"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid BF</span>');
                                    }
                                }
                                else {
                                    if(jQuery('input[name="selected_bf_name"]').parent().parent().parent().find('span.infos').length > 0) {
                                        jQuery('input[name="selected_bf_name"]').parent().parent().parent().find('span.infos').remove();
                                    }
                                }
                            }
                        }
                    }
                    if(jQuery('input[name="selected_quantity"]').length > 0) {
                        selected_quantity = jQuery('input[name="selected_quantity"]').val().trim();
                        if(selected_quantity == "" || selected_quantity == 0 || selected_quantity == null || typeof selected_quantity == "undefined" || number_regex.test(selected_quantity) == false) {
                            all_errors_check = 0;
                            if(jQuery('input[name="selected_quantity"]').parent().parent().parent().find('span.infos').length == 0) {
                                jQuery('input[name="selected_quantity"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid Quantity</span>');
                            }
                        }
                        else {
                            if(jQuery('input[name="selected_quantity"]').parent().parent().parent().find('span.infos').length > 0) {
                                jQuery('input[name="selected_quantity"]').parent().parent().parent().find('span.infos').remove();
                            }
                        }
                    }
                    if(jQuery('.product_table').find('tr.product_row').length > 0) {
                        jQuery('.product_table').find('tr.product_row').each(function() {
                            var prev_godown_id = ""; var prev_size_id = ""; var prev_gsm_id = ""; var prev_bf_id = "";
                            if(jQuery(this).find('select[name="godown_id[]"]').length > 0) {
                                prev_godown_id = jQuery(this).find('select[name="godown_id[]"]').val().trim();
                            }
                            if(jQuery(this).find('select[name="size_id[]"]').length > 0) {
                                prev_size_id = jQuery(this).find('select[name="size_id[]"]').val().trim();
                            }
                            if(jQuery(this).find('select[name="gsm_id[]"]').length > 0) {
                                prev_gsm_id = jQuery(this).find('select[name="gsm_id[]"]').val().trim();
                            }
                            if(jQuery(this).find('select[name="bf_id[]"]').length > 0) {
                                prev_bf_id = jQuery(this).find('select[name="bf_id[]"]').val().trim();
                            }
                            if(parseInt(location_type) == 1) {
                                if(prev_godown_id == selected_godown_id && prev_size_id == selected_size_id && prev_gsm_id == selected_gsm_id && prev_bf_id == selected_bf_id) {
                                    if(error == "") {
                                        error = "This Combination already exists in the table";
                                    }
                                }
                            }
                            else {
                                if(prev_size_id == selected_size_id && prev_gsm_id == selected_gsm_id && prev_bf_id == selected_bf_id) {
                                    if(error == "") {
                                        error = "This Combination already exists in the table";
                                    }
                                }
                            }
                        });
                    }
                }
                if(parseInt(all_errors_check) == 1) {
                    if(error == "") {
                        var post_url = "inward_material_changes.php?product_row_index="+product_count+"&selected_location_type="+location_type+"&selected_godown_type="+godown_type+"&selected_godown_id="+selected_godown_id+"&selected_factory_id="+selected_factory_id+"&selected_size_id="+selected_size_id+"&selected_gsm_id="+selected_gsm_id+"&selected_bf_id="+selected_bf_id+"&selected_quantity="+selected_quantity;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.product_table tbody').find('tr.product_row').length > 0) {
                                    jQuery('.product_table tbody').find('tr.product_row:last').after(result);
                                }
                                else {
                                    jQuery('.product_table tbody').html(result);
                                }
                                if(jQuery('input[name="product_count"]').length > 0) {
                                    jQuery('input[name="product_count"]').val(product_count);
                                }
                                if (jQuery('.tableheight .product_table tbody tr.product_row').length > 0) {
                                    var scroll_container = jQuery('.tableheight');
                                    var last_row = jQuery('.tableheight .product_table tbody tr.product_row:last');

                                    scroll_container.stop().animate({
                                        scrollTop: scroll_container.scrollTop() + last_row.position().top
                                    }, 300);
                                }
                                if(empty_row == "") {
                                    var values = Array('size', 'gsm', 'bf');
                                    for(var i=0; i < values.length; i++) {
                                        ClearCustomButton(values[i]);
                                    }
                                    if(jQuery('input[name="selected_quantity"]').length > 0) {
                                        jQuery('input[name="selected_quantity"]').val('');
                                    }
                                }
                                if(jQuery('select[name="location_type"]').length > 0) {
                                    jQuery('select[name="location_type"]').parent().css('pointer-events', 'none');
                                    jQuery('select[name="location_type"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
                                }
                                if(jQuery('select[name="godown_type"]').length > 0) {
                                    jQuery('select[name="godown_type"]').parent().css('pointer-events', 'none');
                                    jQuery('select[name="godown_type"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
                                }
                                if(parseInt(location_type) == 2) {
                                    if(jQuery('select[name="selected_factory_id"]').length > 0) {
                                        jQuery('select[name="selected_factory_id"]').parent().css('pointer-events', 'none');
                                        jQuery('select[name="selected_factory_id"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
                                    }
                                }
                                if(parseInt(godown_type) == 1) {
                                    if(jQuery('select[name="selected_godown_id"]').length > 0) {
                                        jQuery('select[name="selected_godown_id"]').parent().css('pointer-events', 'none');
                                        jQuery('select[name="selected_godown_id"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
                                    }
                                }
                                if(jQuery('.add_product_button').length > 0) {
                                    jQuery('.add_product_button').attr('disabled', false);
                                }
                                SnoCalcPlus();
                            }
                        });
                    }
                    else {
                        if (jQuery('.table-infos').length > 0) {
                            jQuery('.table-infos').html('<i class="fa fa-exclamation-circle"></i>'+error);
                        }
                        if(jQuery('.add_product_button').length > 0) {
                            jQuery('.add_product_button').attr('disabled', false);
                        }
                    }
                }
                else {
                    if(jQuery('.add_product_button').length > 0) {
                        jQuery('.add_product_button').attr('disabled', false);
                    }
                }
			}
			else {
				window.location.reload();
			}
		}
	});
}
function DeleteProductRow(id_name, row_index) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (jQuery('#'+id_name+row_index).length > 0) {
					jQuery('#'+id_name+row_index).remove();
				}
                if(jQuery('.'+id_name).length == 0 && id_name == 'product_row') {
                    if(jQuery('.product_table').find('tbody').length > 0) {
                        jQuery('.product_table').find('tbody').html('<tr class="no_data_row"><th colspan="7" class="text-center px-2 py-2">No Data Found!</th></tr>');
                    }
                    if(jQuery('select[name="location_type"]').length > 0) {
                        jQuery('select[name="location_type"]').parent().css('pointer-events', 'auto');
                        jQuery('select[name="location_type"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '0');
                    }
                    if(jQuery('select[name="godown_type"]').length > 0) {
                        jQuery('select[name="godown_type"]').parent().css('pointer-events', 'auto');
                        jQuery('select[name="godown_type"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '0');
                    }
                    if(jQuery('select[name="selected_godown_id"]').length > 0) {
                        jQuery('select[name="selected_godown_id"]').parent().css('pointer-events', 'auto');
                        jQuery('select[name="selected_godown_id"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '0');
                    }
                }
                SnoCalcPlus();
			}
			else {
				window.location.reload();
			}
		}
	});
}
function InwardRowCheck(obj) {
    if(jQuery(obj).closest('tr.product_row').find('span.infos').length > 0) {
        jQuery(obj).closest('tr.product_row').find('span.infos').remove();
    }
    if(jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').length > 0) {
        selected_quantity = jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').val().trim();
        if(number_regex.test(selected_quantity) == false) {
            if(jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').parent().find('span.infos').length == 0) {
                jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').after('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid Qty</span>');
            }
        }
    }
}
function CustomButton(value) {
    if(jQuery('#selected_'+value+'_id_div').length > 0) {
        if(jQuery('#selected_'+value+'_id_group').length > 0) {
            jQuery('#selected_'+value+'_id_group').addClass('d-none');
        }
        if(jQuery('#selected_'+value+'_name_group').length > 0) {
            jQuery('#selected_'+value+'_name_group').removeClass('d-none');
        }
        if(jQuery('select[name="selected_'+value+'_id"]').length > 0) {
            jQuery('select[name="selected_'+value+'_id"]').val('').trigger('change');
        }
        if(jQuery('input[name="selected_'+value+'_name"]').length > 0) {
            jQuery('input[name="selected_'+value+'_name"]').val('');
        }
    }
}
function ClearCustomButton(value) {
    if(jQuery('#selected_'+value+'_id_div').length > 0) {
        if(jQuery('#selected_'+value+'_id_group').length > 0) {
            jQuery('#selected_'+value+'_id_group').removeClass('d-none');
        }
        if(jQuery('#selected_'+value+'_name_group').length > 0) {
            jQuery('#selected_'+value+'_name_group').addClass('d-none');
        }
        if(jQuery('select[name="selected_'+value+'_id"]').length > 0) {
            jQuery('select[name="selected_'+value+'_id"]').val('').trigger('change');
        }
        if(jQuery('input[name="selected_'+value+'_name"]').length > 0) {
            jQuery('input[name="selected_'+value+'_name"]').val('');
        }
    }
}