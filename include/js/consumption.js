var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;

function AddConsumptionRow(empty_row) {
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
                var error = ""; var all_errors_check = 1;stock=1;
                var product_count = 0;
                if(jQuery('input[name="product_count"]').length > 0) {
                    product_count = jQuery('input[name="product_count"]').val().trim();
                    product_count = parseInt(product_count) + 1;
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
                    
                    if(jQuery('input[name="selected_quantity"]').length > 0) {
                        selected_quantity = jQuery('input[name="selected_quantity"]').val().trim();
                        if(selected_quantity == "" || selected_quantity == 0 || selected_quantity == null || typeof selected_quantity == "undefined" || number_regex.test(selected_quantity) == false) {
                            all_errors_check = 0;
                            if(jQuery('input[name="selected_quantity"]').parent().parent().parent().find('span.infos').length == 0) {
                                jQuery('input[name="selected_quantity"]').parent().parent().append('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid Quantity</span>');
                            }
                        }
                        
                    }
                    if(jQuery('.product_table').find('tr.product_row').length > 0) {
                        jQuery('.product_table').find('tr.product_row').each(function() {
                            var prev_size_id = ""; var prev_gsm_id = ""; var prev_bf_id = "";
                           
                            if(jQuery(this).find('select[name="size_id[]"]').length > 0) {
                                prev_size_id = jQuery(this).find('select[name="size_id[]"]').val().trim();
                            }
                            if(jQuery(this).find('select[name="gsm_id[]"]').length > 0) {
                                prev_gsm_id = jQuery(this).find('select[name="gsm_id[]"]').val().trim();
                            }
                            if(jQuery(this).find('select[name="bf_id[]"]').length > 0) {
                                prev_bf_id = jQuery(this).find('select[name="bf_id[]"]').val().trim();
                            }
                            
                            if(prev_size_id == selected_size_id && prev_gsm_id == selected_gsm_id && prev_bf_id == selected_bf_id) {
                                if(error == "") {
                                    error = "This Combination already exists in the table";
                                }
                            }
                            
                        });
                    }
                }
                var current_stock =0
                if(jQuery('input[name="current_stock"]').length > 0) {
                    current_stock = jQuery('input[name="current_stock"]').val().trim();
                }
                
                if(selected_quantity > current_stock){
                    stock= 0;
                }
                if(parseInt(all_errors_check) == 1) {
                    if(error == "") {
                        if(parseInt(stock) == 1){
                            var post_url = "consumption_entry_changes.php?product_row_index="+product_count+"&selected_size_id="+selected_size_id+"&selected_gsm_id="+selected_gsm_id+"&selected_bf_id="+selected_bf_id+"&selected_quantity="+selected_quantity;
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
                                    if(jQuery('select[name="selected_size_id"]').length > 0) {
                                        jQuery('select[name="selected_size_id"]').val('').trigger('change');
                                    }
                                    if(jQuery('select[name="selected_gsm_id"]').length > 0) {
                                        jQuery('select[name="selected_gsm_id"]').val('').trigger('change');
                                    }
                                    if(jQuery('select[name="selected_bf_id"]').length > 0) {
                                        jQuery('select[name="selected_bf_id"]').val('').trigger('change');
                                    }
                                    if(jQuery('input[name="selected_quantity"]').length > 0) {
                                        jQuery('input[name="selected_quantity"]').val('');
                                    }
                                    if (jQuery('.infos').length > 0) {
                                        jQuery('.infos').html('');
                                    }
                                    if(jQuery('.add_product_button').length > 0) {
                                        jQuery('.add_product_button').attr('disabled', false);
                                    }
                                    SnoCalcPlus();
                                }
                            });
                        }else{
                            jQuery('.product_table').before('<span class="infos w-100 text-center mb-1 fw-bold" style="font-size: 15px;">Quantity is Greater than Current Stock</span>');
                            if(jQuery('.add_product_button').length > 0) {
                                jQuery('.add_product_button').attr('disabled', false);
                            }
                        }
                    }
                    else {
                        if (jQuery('.table-infos').length > 0) {
                            jQuery('.table-infos').html('<i class="fa fa-exclamation-circle"></i>'+error);
                        }
                        if(jQuery('.add_product_button').length > 0) {
                            jQuery('.add_product_button').attr('disabled', false);
                        }
                    }
                }else{
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
                }
                SnoCalcPlus();
			}
			else {
				window.location.reload();
			}
		}
	});
}

function ConsumptionRowCheck(obj) {
    if(jQuery(obj).closest('tr.product_row').find('span.infos').length > 0) {
        jQuery(obj).closest('tr.product_row').find('span.infos').remove();
    }
    if(jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').length > 0) {
        selected_quantity = jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').val().trim();
        if(selected_quantity != "" && number_regex.test(selected_quantity) == false) {
            if(jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').parent().find('span.infos').length == 0) {
                jQuery(obj).closest('tr.product_row').find('input[name="quantity[]"]').after('<span class="infos text-danger"><i class="fa fa-exclamation-circle"></i>Enter Valid Qty</span>');
            }
        }
    }
}

function GetCurrentStock() {
    if (jQuery('.current_stock_div').length > 0) {
        jQuery('.current_stock_div').html('');
    }
    var selected_factory_id = ""; var selected_size_id = ""; var selected_gsm_id = ""; var selected_bf_id = "";
    if (jQuery('select[name="selected_factory_id"]').length > 0) {
        selected_factory_id = jQuery('select[name="selected_factory_id"]').val();
    }
    if (jQuery('select[name="selected_size_id"]').length > 0) {
        selected_size_id = jQuery('select[name="selected_size_id"]').val();
    }
    if (jQuery('select[name="selected_gsm_id"]').length > 0) {
        selected_gsm_id = jQuery('select[name="selected_gsm_id"]').val();
    }
    if (jQuery('select[name="selected_bf_id"]').length > 0) {
        selected_bf_id = jQuery('select[name="selected_bf_id"]').val();
    }
 
    var post_url = "consumption_entry_changes.php?get_factory_id=" + selected_factory_id + "&selected_size_id=" + selected_size_id + "&selected_gsm_id=" + selected_gsm_id + "&selected_bf_id=" + selected_bf_id;

    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.split("$$$");
           
            if (jQuery('.current_stock_div').length > 0) {
                jQuery('.current_stock_div').html(result[0]);
            }
            if (jQuery('input[name="current_stock"]').length > 0) {
                jQuery('input[name="current_stock"]').val(result[1].trim());
            }
        }
    });
}