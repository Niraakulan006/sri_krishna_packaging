var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
// JavaScript Document
function CheckPassword(field_name) {
	var password = "";
	if (jQuery('input[name="password"]').length > 0) {
		password = jQuery('input[name="password"]').val();
		//password = jQuery.trim(password);
	}

	if (jQuery('#password_cover').length > 0) {
		if (jQuery('#password_cover').find('label').length > 0) {
			jQuery('#password_cover').find('label').addClass('text-danger');
		}
		if (jQuery('#password_cover').find('input[name="length_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="length_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="letter_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="letter_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="number_symbol_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="number_symbol_check"]').prop('checked', false);
		}
		if (jQuery('#password_cover').find('input[name="space_check"]').length > 0) {
			jQuery('#password_cover').find('input[name="space_check"]').prop('checked', false);
		}

		var upper_regex = /[A-Z]/; var lower_regex = /[a-z]/;
		var number_regex = /\d/; var symbol_regex = /[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\]/; var no_space_regex = /^\S+$/;

		if (typeof password != "undefined" && password != null && password != "") {
			var password_length = password.length;
			if (parseInt(password_length) >= 8 && parseInt(password_length) <= 20) {
				if (jQuery('#password_cover').find('input[name="length_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="length_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="length_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if ((upper_regex.test(password) == true) && (lower_regex.test(password) == true)) {
				if (jQuery('#password_cover').find('input[name="letter_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="letter_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="letter_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if ((number_regex.test(password) == true) && (symbol_regex.test(password) == true)) {
				if (jQuery('#password_cover').find('input[name="number_symbol_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="number_symbol_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="number_symbol_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
			if (no_space_regex.test(password) == true) {
				if (jQuery('#password_cover').find('input[name="space_check"]').length > 0) {
					jQuery('#password_cover').find('input[name="space_check"]').prop('checked', true);
					if (jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').length > 0) {
						jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').removeClass('text-danger');
						jQuery('#password_cover').find('input[name="space_check"]').parent().find('label').addClass('text-success');
					}
				}
			}
		}
	}
}

function CustomCheckboxToggle(obj, toggle_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
				if (jQuery('.staff_access_table').length > 0) {
					toggle_id = toggle_id.replace('view', '');
					toggle_id = toggle_id.replace('add', '');
					toggle_id = toggle_id.replace('edit', '');
					toggle_id = toggle_id.replace('delete', '');
					toggle_id = jQuery.trim(toggle_id);
					var checkbox_cover = toggle_id + "cover";
					//console.log('checkbox_cover - '+checkbox_cover+', checbox count - '+jQuery('#'+checkbox_cover).find('input[type="checkbox"]').length);
					if (jQuery('#' + checkbox_cover).find('input[type="checkbox"]').length > 0) {
						var view_checkbox = toggle_id + "view"; var add_checkbox = toggle_id + "add"; var edit_checkbox = toggle_id + "edit";
						var delete_checkbox = toggle_id + "delete"; var select_count = 0; var select_all_checkbox = toggle_id + "select_all";
						//console.log('add_checkbox - '+add_checkbox+', edit_checkbox - '+edit_checkbox+', delete_checkbox - '+delete_checkbox+', select_all_checkbox - '+select_all_checkbox);
						var view_count = 0;
						if (jQuery('#' + view_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + add_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + edit_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (jQuery('#' + delete_checkbox).prop('checked') == true) {
							select_count = parseInt(select_count) + 1;
							view_count = parseInt(view_count) + 1;
						}
						if (parseInt(select_count) == 4 || (toggle_id == '5247567361585a6c636e6b675532787063413d3d_' && parseInt(select_count) == 3) || (toggle_id == '5357353359584a6b4945467763484a76646d4673_' && parseInt(select_count) == 3)) {
							jQuery('#' + select_all_checkbox).prop('checked', true);
						}
						else {
							jQuery('#' + select_all_checkbox).prop('checked', false);
						}
						if(parseInt(view_count) > 0){
							jQuery('#' + view_checkbox).prop('checked', true);
							jQuery('#' + view_checkbox).val('1');
						}
						else {
							jQuery('#' + view_checkbox).prop('checked', false);
							jQuery('#' + view_checkbox).val('2');
						}
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function SelectAllModuleActionToggle(obj, toggle_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var toggle_value = 2;
				if (jQuery('#' + toggle_id).length > 0) {
					if (jQuery('#' + toggle_id).prop('checked') == true) {
						toggle_value = 1;
					}
					jQuery('#' + toggle_id).val(toggle_value);
				}
				if (parseInt(toggle_value) == 1) {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', true);
							jQuery(this).val('1');
						});
					}
				}
				else {
					if (jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').length > 0) {
						jQuery('#' + toggle_id).parent().parent().parent().parent().find('input[type="checkbox"]').each(function () {
							jQuery(this).prop('checked', false);
							jQuery(this).val('2');
						});
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function FormSubmit(event, form_name, submit_page, redirection_page) {
	event.preventDefault();

	if (jQuery('div.alert').length > 0) {
		jQuery('div.alert').remove();
	}
	jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger mb-5"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>');

	if (jQuery('.submit_button').length > 0) {
		jQuery('.submit_button').attr('disabled', true);
	}
	jQuery.ajax({
		url: submit_page,
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: 'html',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery('span.infos').length > 0) {
				jQuery('span.infos').remove();
			}
			if (jQuery('.valid_error').length > 0) {
				jQuery('.valid_error').remove();
			}
			if (jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}

			if (typeof x.redirection_page != "undefined" && x.redirection_page != "") {
				redirection_page = x.redirection_page;
			}

			if (x.number == '1') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
				setTimeout(function () {
					if (typeof redirection_page != "undefined" && redirection_page != "") {
						window.location = redirection_page;
					}
					else {
						window.location.reload();
					}
				}, 1000);
			}

			if (x.number == '2') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				if (jQuery('.submit_button').length > 0) {
					jQuery('.submit_button').attr('disabled', false);
				}
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
			}

			if (x.number == '3') {
				jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
				if (jQuery('.submit_button').length > 0) {
					jQuery('.submit_button').attr('disabled', false);
				}
				jQuery('html, body').animate({
					scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
				}, 500);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});
}
function table_listing_records_filter() {
	if (jQuery('#table_listing_records').length > 0) {
		jQuery('#table_listing_records').html('<div class="alert alert-success mb-3 mx-3"> Loading... </div>');
	}

	var check_login_session = 1;
	// var post_url = "dashboard_changes.php?check_login_session=1";
	// jQuery.ajax({
	// 	url: post_url, success: function (check_login_session) {
	if (check_login_session == 1) {
		var page_title = ""; var post_send_file = "";
		if (jQuery('input[name="page_title"]').length > 0) {
			page_title = jQuery('input[name="page_title"]').val();
			if (typeof page_title != "undefined" && page_title != "") {
				page_title = page_title.replaceAll(" ", "_");
				page_title = page_title.toLowerCase();
				page_title = jQuery.trim(page_title);
				post_send_file = page_title + "_changes.php";
			}
		}
		jQuery.ajax({
			url: post_send_file,
			type: "post",
			async: true,
			data: jQuery('form[name="table_listing_form"]').serialize(),
			dataType: 'html',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			success: function (result) {
				if (jQuery('.alert').length > 0) {
					jQuery('.alert').remove();
				}
				if (jQuery('#table_listing_records').length > 0) {
					jQuery('#table_listing_records').html(result);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	else {
		window.location.reload();
	}
	// 	}
	// });
}

function ShowModalContent(page_title, add_edit_id_value) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	// jQuery.ajax({url: post_url, success: function(check_login_session){
	// 	if(check_login_session == 1) {
	var add_edit_id = ""; var post_send_file = ""; var heading = "";
	if (typeof page_title != "undefined" && page_title != "") {
		heading = page_title;
		page_title = page_title.replaceAll(" ", "_");
		page_title = page_title.toLowerCase();
		add_edit_id = "show_" + page_title + "_id";
		post_send_file = page_title + "_changes.php";
		page_title = page_title + " Details";
		if (jQuery('.edit_title').length > 0) {
			page_title = page_title.replaceAll("_", " ");
			page_title = page_title.toLowerCase().replace(/\b[a-z]/g, function (string) {
				return string.toUpperCase();
			});
			jQuery('.edit_title').html(page_title);
		}
		if (jQuery('#table_records_cover').length > 0) {
			jQuery('#table_records_cover').addClass('d-none');
		}
		if (jQuery('#add_update_form_content').length > 0) {
			jQuery('#add_update_form_content').removeClass('d-none');
		}
	}
	var post_url = post_send_file + "?" + add_edit_id + "=" + add_edit_id_value;
	jQuery.ajax({
		url: post_url, success: function (result) {
			if (jQuery('.add_update_form_content').length > 0) {
				jQuery('.add_update_form_content').html("");
				jQuery('.add_update_form_content').html(result);
			}
			jQuery('html, body').animate({
				scrollTop: (jQuery('.add_update_form_content').parent().parent().offset().top)
			}, 500);
		}
	});
	// }
	// else {
	// 	window.location.reload();
	// }
	// }});
}

function SaveModalContent(form_name, post_send_file, redirection_file) {
	if (jQuery('span.infos').length > 0) {
		jQuery('span.infos').remove();
	}
	if (jQuery('.valid_error').length > 0) {
		jQuery('.valid_error').remove();
	}
	if (jQuery('div.alert').length > 0) {
		jQuery('div.alert').remove();
	}
	jQuery(window).off('beforeunload');
	jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger mb-3"> Processing </div>');
	if(form_name != "bill_product_form") {
		if (jQuery('.submit_button').length > 0) {
			jQuery('.submit_button').attr('disabled', true);
		}
	}
	if (form_name != "register_form" && form_name != "login_form") {
		jQuery('html, body').animate({
			scrollTop: (jQuery('body').offset().top)
		}, 500);
		var check_login_session = 1;
		var post_url = "dashboard_changes.php?check_login_session=1";
		jQuery.ajax({
			url: post_url, success: function (check_login_session) {
				if (check_login_session == 1) {
					SendModalContent(form_name, post_send_file, redirection_file);
				}
				else {
					window.location.reload();
				}
			}
		});
	}
	else {
		jQuery('html, body').animate({
			scrollTop: (jQuery('form[name="' + form_name + '"]').offset().top)
		}, 500);
		SendModalContent(form_name, post_send_file, redirection_file);
	}
}

function SendModalContent(form_name, post_send_file, redirection_file) {
	jQuery.ajax({
		url: post_send_file,
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: 'html',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery('span.infos').length > 0) {
				jQuery('span.infos').remove();
			}
			if (jQuery('.valid_error').length > 0) {
				jQuery('.valid_error').remove();
			}
			if (jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}
			if (x.number == '1') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				setTimeout(function () {
					var page_title = "";
					if(jQuery('input[name="page_title"]').length > 0) {
						page_title = jQuery('input[name="page_title"]').val();
						page_title = page_title.trim();
					}
					if(x.supplier_id != "" && x.supplier_id != null && typeof x.supplier_id != "undefined" && (page_title == 'Inward Material')) {	
						if(jQuery('#CustomPartyModal .btn-close').length > 0) {
							jQuery('#CustomPartyModal .btn-close').trigger('click');	
						}
						if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
							jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
						}
						ChangeSupplierIDs(x.supplier_id);
					}
					else if (jQuery('.redirection_form').length > 0) {
						if (typeof x.redirection_page != "undefined" && x.redirection_page != "") {
							window.location = x.redirection_page;
						}
						else {
							window.location = redirection_file;
						}
					}
					else {

						if (jQuery('#StockUpdateModal').length > 0) {
							jQuery('#StockUpdateModal .modal-header .close').trigger("click");
						}

						if (jQuery('.add_update_form_content').length > 0) {
							jQuery('.add_update_form_content').html("");
						}
						if (jQuery('#AcknowledgementModal').length > 0) {
							jQuery('#AcknowledgementModal .modal-header .close').trigger("click");
						}
						if (jQuery('#clearancemodal').length > 0) {
							jQuery('#clearancemodal .modal-header .close').trigger("click");
						}
						if (jQuery('#table_records_cover').hasClass('d-none')) {
							jQuery('#table_records_cover').removeClass('d-none');
						}
						if (form_name == 'bill_company_form') {
							setTimeout(function () {
								window.location.reload();
							}, 1500);
						}
						else {
							table_listing_records_filter();
						}
					}
				}, 1000);
			}

			if (x.number == '2') {
				jQuery('form[name="' + form_name + '"]').find('.row:first').before('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' + x.msg + ' </div>');
				if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
					jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
				}
			}

			if (x.number == '3') {
				jQuery('form[name="' + form_name + '"]').append('<div class="valid_error"> <script type="text/javascript"> ' + x.msg + ' </script> </div>');
				if (jQuery('form[name="' + form_name + '"]').find('.submit_button').length > 0) {
					jQuery('form[name="' + form_name + '"]').find('.submit_button').attr('disabled', false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});
}

function DeleteModalContent(page_title, delete_content_id) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (typeof page_title != "undefined" && page_title != "") {
					jQuery('#DeleteModal .modal-header').find('h4').html("");
					if (page_title == "Inward Material" || page_title == "Material Transfer" || page_title == "Stock Request" || page_title == "Consumption Entry" || page_title == "Delivery Slip" || page_title == "Stock Adjustment" || page_title == "Inward Approval") {
						jQuery('#DeleteModal .modal-header').find('h4').html("Cancel " + page_title);
					}
					else {
						jQuery('#DeleteModal .modal-header').find('h4').html("Delete " + page_title);
					}
					page_title = page_title.toLowerCase();
				}
				jQuery('.delete_modal_button').trigger("click");
				jQuery('#DeleteModal .modal-body').html('');
				if (page_title == "inward material" || page_title == "material transfer" || page_title == "stock request" || page_title == "consumption entry" || page_title == "delivery slip" || page_title == "stock adjustment" || page_title == "inward_approval") {
					jQuery('#DeleteModal .modal-body').html('Are you surely want to cancel this ' + page_title + '?');
				}
				else {
					jQuery('#DeleteModal .modal-body').html('Are you surely want to delete this ' + page_title + '?');
				}

				jQuery('#DeleteModal .modal-footer .yes').attr('id', delete_content_id);
				jQuery('#DeleteModal .modal-footer .no').attr('id', delete_content_id);
			}
			else {
				window.location.reload();
			}
		}
	});
}
function DeleteNumberModalContent(page_title, delete_content_id) {

	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				if (typeof page_title != "undefined" && page_title != "") {
					jQuery('#ReceiptDeleteModal .modal-header').find('h4').html("");
					jQuery('#ReceiptDeleteModal .modal-header').find('h4').html("Delete " + page_title);

					page_title = page_title.toLowerCase();
				}
				jQuery('.receipt_delete_modal_button').trigger("click");
				jQuery('#ReceiptDeleteModal .modal-body').html('');

				if (page_title == "quotation" || page_title == "estimate" || page_title == "invoice") {
					jQuery('#ReceiptDeleteModal .modal-body').html('Are you surely want to cancel this ' + page_title + '?');
				}
				else {
					jQuery('#ReceiptDeleteModal .modal-body').html('Are you surely want to delete this ' + page_title + '?');
				}

				jQuery('#ReceiptDeleteModal .modal-footer .yes').attr('id', delete_content_id);
				jQuery('#ReceiptDeleteModal .modal-footer .no').attr('id', delete_content_id);
			}
			else {
				window.location.reload();
			}
		}
	});
}

function confirm_delete_modal(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('#DeleteModal .modal-body').find('.infos').length > 0) {
					jQuery('#DeleteModal .modal-body').find('.infos').remove();
				}

				var page_title = ""; var post_send_file = "";
				if (jQuery('input[name="page_title"]').length > 0) {
					page_title = jQuery('input[name="page_title"]').val();
					if (typeof page_title != "undefined" && page_title != "") {
						page_title = page_title.replaceAll(" ", "_");
						page_title = page_title.toLowerCase();
						page_title = jQuery.trim(page_title);
						post_send_file = page_title + "_changes.php";
					}
				}
				var delete_content_id = jQuery(obj).attr('id');
				if (page_title != 'receipt') {
					var post_url = post_send_file + "?delete_" + page_title + "_id=" + delete_content_id;
					jQuery.ajax({
						url: post_url, success: function (result) {
							jQuery('#DeleteModal .modal-content').animate({ scrollTop: 0 }, 500);
							result = result.trim();
							var intRegex = /^\d+$/;
							if (intRegex.test(result) == true) {
								if (page_title == "inward_material" || page_title == "material_transfer" || page_title == "stock_request" || page_title == "consumption_entry" || page_title == "stock_request" || page_title == "delivery_slip" || page_title == "inward_approval") {
									jQuery('#DeleteModal .modal-body').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> Successfully Cancel the ' + page_title.replaceAll("_", " ") + ' </div>');
								}
								else {
									jQuery('#DeleteModal .modal-body').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> Successfully Delete the ' + page_title.replaceAll("_", " ") + ' </div>');
								}
								setTimeout(function () {
									jQuery('#DeleteModal .modal-header .close').trigger("click");
									window.location.reload();
								}, 1000);

							}
							else {
								jQuery('#DeleteModal .modal-body').append('<span class="infos w-100 text-center" style="font-size: 15px; font-weight: bold;">' + result + '</span>');
							}
						}
					});
				}
				else {
					RemarksModalContent(delete_content_id, '')
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}
function cancel_delete_modal(obj) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				jQuery('#DeleteModal .modal-header .close').trigger("click");
			}
			else {
				window.location.reload();
			}
		}
	});
}
function AlertMessage(message, redirection_file) {
	if(jQuery('#alertModal').find('.modal-body').length > 0) {
		jQuery('#alertModal').find('.modal-body').html(message);
	}
	if(jQuery('#alertModal').find('.btn-close').length > 0 && redirection_file != "" && typeof redirection_file != "undefined" && redirection_file != null) {
		jQuery('#alertModal').find('.btn-close').attr('onclick', 'window.open("'+redirection_file+'", "_self")');
	}
	if(jQuery('.alert_modal_button').length > 0) {
		jQuery('.alert_modal_button').trigger('click');
	}
}
function CustomParty() {
	if (jQuery('#CustomPartyModal').length > 0) {
		jQuery('#CustomPartyModal').find('.modal-body').html('');
	}
	var post_url = "supplier_changes.php?show_supplier_id=&add_custom_supplier=1";
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = jQuery.trim(result);
			if (jQuery('#CustomPartyModal').length > 0) {
				jQuery('#CustomPartyModal').find('.modal-body').html(result);
			}
			if (jQuery('.custom_party_modal_button').length > 0) {
				jQuery('.custom_party_modal_button').trigger('click');
			}
		}
	});
}
function ChangeSupplierIDs(supplier_id) {
    var post_url = "inward_material_changes.php?change_supplier_list=1"+"selected_supplier_id="+supplier_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (jQuery('select[name="supplier_id"]').length > 0) {
                jQuery('select[name="supplier_id"]').html(result);
            }
            if (supplier_id != "" && supplier_id != null && typeof supplier_id != "undefined") {
                if (jQuery('select[name="supplier_id"]').length > 0) {
                    jQuery('select[name="supplier_id"]').val(supplier_id).trigger('change');
                }
            }
        }
    });
}
function SnoCalcPlus() {
    var snoElements = document.getElementsByClassName('sno');
    if (snoElements.length > 0) {
        for (var i = 0; i < snoElements.length; i++) {
            snoElements[i].innerHTML = i + 1;
        }
    }
}
function TotalReelsCount() {
	var total_quantity = 0;
	if(jQuery('tr.product_row').length > 0) {
		jQuery('tr.product_row').each(function() {
			var quantity = 0;
			if(jQuery(this).find('input[name="quantity[]"]').length > 0) {
				quantity = jQuery(this).find('input[name="quantity[]"]').val().trim();
				if(number_regex.test(quantity) !== false) {
					total_quantity = parseInt(total_quantity) + parseInt(quantity);
				}
			}
		});
	}
	if(jQuery('.total_reels_span').length > 0) {
		jQuery('.total_reels_span').html(total_quantity);
	}
}
function ViewBillContent(table, bill_id) {
	if (jQuery('#ViewBillModal').length > 0) {
		jQuery('#ViewBillModal').find('.modal-body').html('');
	}
	var post_url = "view_bill_changes.php?view_table="+table+"&view_bill_id="+bill_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = jQuery.trim(result);
			result = result.split("$$$");
			if (jQuery('#ViewBillModal').length > 0) {
				jQuery('#ViewBillModal').find('.modal-body').html(result[0]);
			}
			if (jQuery('#ViewBillModal').length > 0) {
				jQuery('#ViewBillModal').find('.modal-title').html(result[1]);
			}
			if (jQuery('.view_bill_modal_button').length > 0) {
				jQuery('.view_bill_modal_button').trigger('click');
			}
		}
	});
}

function ShowStockRequestConversion(stock_request_id) {
    var post_url = "delivery_slip_changes.php?show_delivery_slip_id=&conversion_request_id="+stock_request_id;
    jQuery.ajax({url: post_url, success: function (result) {
		if (jQuery('#table_records_cover').length > 0) {
			jQuery('#table_records_cover').addClass('d-none');
		}
		if (jQuery('#add_update_form_content').length > 0) {
			jQuery('#add_update_form_content').removeClass('d-none');
		}
        if (jQuery('.add_update_form_content').length > 0) {
            jQuery('.add_update_form_content').html("");
            jQuery('.add_update_form_content').html(result);
        }
    }});
}

function ShowDeliverySlipConversion(delivery_slip_id) {
    var post_url = "inward_approval_changes.php?show_inward_approval_id=&conversion_delivery_id="+delivery_slip_id;
    jQuery.ajax({url: post_url, success: function (result) {
		if (jQuery('#table_records_cover').length > 0) {
			jQuery('#table_records_cover').addClass('d-none');
		}
		if (jQuery('#add_update_form_content').length > 0) {
			jQuery('#add_update_form_content').removeClass('d-none');
		}
        if (jQuery('.add_update_form_content').length > 0) {
            jQuery('.add_update_form_content').html("");
            jQuery('.add_update_form_content').html(result);
        }
    }});
}

function PendingQtyContent(table, bill_id) {
	if (jQuery('#PendingQtyModal').length > 0) {
		jQuery('#PendingQtyModal').find('.modal-body').html('');
	}
	var post_url = "view_bill_changes.php?pending_table="+table+"&pending_bill_id="+bill_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = jQuery.trim(result);
			if (jQuery('#PendingQtyModal').length > 0) {
				jQuery('#PendingQtyModal').find('.modal-body').html(result);
			}
			if (jQuery('.pending_qty_modal_button').length > 0) {
				jQuery('.pending_qty_modal_button').trigger('click');
			}
		}
	});
}
function ScanBarcode() {
	if(jQuery('#ScanBarcodeModal').find('#reader').parent().find('span.barcode_infos').length > 0) {
		jQuery('#ScanBarcodeModal').find('#reader').parent().find('span.barcode_infos').remove();
	}
	if (jQuery('.scan_barcode_modal_button').length > 0) {
		jQuery('.scan_barcode_modal_button').trigger('click');
	}
	let html5QrCode;
	html5QrCode = new Html5Qrcode("reader");
	html5QrCode.start(
		{ facingMode: "environment" }, // Rear camera
		{
			fps: 10,    // Frames per second
			qrbox: { width: 400, height: 150 }
		},
		
		(decodedText) => {
			var split_text = decodedText.split('-');
			var size = split_text[0];
			var gsm = split_text[1];
			var bf = split_text[2];
			var size_value = ""; var gsm_value = ""; var bf_value = "";
			if(price_regex.test(size) !== false) {
				size_value = size;
			}
			if(number_regex.test(gsm) !== false) {
				gsm_value = gsm;
			}
			if(price_regex.test(bf) !== false) {
				bf_value = bf;
			}
			if(size_value != "" && gsm_value != "" && bf_value != "") {
				if(jQuery('#ScanBarcodeModal').find('#reader').parent().find('span.barcode_infos').length == 0) {
					jQuery('#ScanBarcodeModal').find('#reader').after('<span class="barcode_infos" style="color:green; font-size:12px;">Success</span>');
				}
				var product_count = 0;
                if(jQuery('input[name="product_count"]').length > 0) {
                    product_count = jQuery('input[name="product_count"]').val().trim();
                    product_count = parseInt(product_count) + 1;
                }
				var error = "";
				if(jQuery('.product_table').find('tr.product_row').length > 0) {
                    jQuery('.product_table').find('tr.product_row').each(function() {
                        var prev_size_value = ""; var prev_gsm_value = ""; var prev_bf_value = "";
                        if(jQuery(this).find('select[name="size_id[]"]').length > 0) {
                            prev_size_value = jQuery(this).find('select[name="size_id[]"] option:selected').text().trim();
                        }
                        if(jQuery(this).find('select[name="gsm_id[]"]').length > 0) {
                            prev_gsm_value = jQuery(this).find('select[name="gsm_id[]"] option:selected').text().trim();
                        }
                        if(jQuery(this).find('select[name="bf_id[]"]').length > 0) {
                            prev_bf_value = jQuery(this).find('select[name="bf_id[]"] option:selected').text().trim();
                        }
                        if(prev_size_value == size_value && prev_gsm_value == gsm_value && prev_bf_value == bf_value) {
                            if(error == "") {
                                error = 1; var prev_qty = 0;
								if(jQuery(this).find('input[name="quantity[]"]').length > 0) {
									prev_qty = jQuery(this).find('input[name="quantity[]"]').val().trim();
									if(number_regex.test(prev_qty) !== false) {
										prev_qty = parseInt(prev_qty) + 1;
										jQuery(this).find('input[name="quantity[]"]').val(prev_qty);
									}
								}
                            }
                        }
                    });
                }
				if(error == "") {
					var post_url = "delivery_slip_changes.php?barcode_row_index="+product_count+"&barcode_size="+size_value+"&barcode_gsm="+gsm_value+"&barcode_bf="+bf_value;
					jQuery.ajax({
						url: post_url, success: function (result) {
							result = jQuery.trim(result);
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
							if(jQuery('select[name="godown_id"]').length > 0) {
								jQuery('select[name="godown_id"]').parent().css('pointer-events', 'none');
								jQuery('select[name="godown_id"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
							}
							if(jQuery('select[name="factory_id"]').length > 0) {
								jQuery('select[name="factory_id"]').parent().css('pointer-events', 'none');
								jQuery('select[name="factory_id"]').parent().find('.select2-selection.select2-selection--single').attr('tabindex', '1');
							}
							if(jQuery('.add_product_button').length > 0) {
								jQuery('.add_product_button').attr('disabled', false);
							}
							SnoCalcPlus();
							TotalReelsCount();
						}
					});
					
					html5QrCode.stop(); // stop scanning
					if(jQuery('#ScanBarcodeModal').find('.btn-close').length > 0) {
						jQuery('#ScanBarcodeModal').find('.btn-close').trigger('click');
					}
				}
				else {
					html5QrCode.stop(); // stop scanning
					if(jQuery('#ScanBarcodeModal').find('.btn-close').length > 0) {
						jQuery('#ScanBarcodeModal').find('.btn-close').trigger('click');
					}
				}
			}
			else {
				if(jQuery('#ScanBarcodeModal').find('#reader').parent().find('span.barcode_infos').length == 0) {
					jQuery('#ScanBarcodeModal').find('#reader').after('<span class="barcode_infos" style="color:red; font-size:12px;">Invalid Barcode</span>');
				}
			}
		},
		(errorMessage) => {
			console.log("No barcode detected", errorMessage);
		}
	).catch(err => {
		console.error("Camera start error:", err);
	});
}

function GetCurrentStock(screen) {
    if (jQuery('.current_stock_div').length > 0) {
        jQuery('.current_stock_div').addClass('d-none');
    }
	if (jQuery('.current_stock_span').length > 0) {
        jQuery('.current_stock_span').html('');
    }
	var location_type = ""; var factory_id = ""; var godown_id = ""; var size_id = ""; var gsm_id = ""; var bf_id = "";
	if(screen == 'inward_material' || screen == 'stock_adjustment') {
		if(jQuery('select[name="location_type"]').length > 0) {
			location_type = jQuery('select[name="location_type"]').val().trim();
		}
		if(jQuery('select[name="selected_factory_id"]').length > 0) {
			factory_id = jQuery('select[name="selected_factory_id"]').val().trim();
		}
		if(jQuery('select[name="selected_godown_id"]').length > 0) {
			godown_id = jQuery('select[name="selected_godown_id"]').val().trim();
		}
	}
	else if(screen == 'material_transfer') {
		location_type = 2;
		if(jQuery('select[name="factory_id"]').length > 0) {
			factory_id = jQuery('select[name="factory_id"]').val().trim();
		}
	}
	else if(screen == 'stock_request' || screen == 'delivery_slip') {
		location_type = 1;
		if(jQuery('select[name="godown_id"]').length > 0) {
			godown_id = jQuery('select[name="godown_id"]').val().trim();
		}
	}
	else if(screen == 'consumption_entry') {
		location_type = 2;
		if(jQuery('select[name="selected_factory_id"]').length > 0) {
			factory_id = jQuery('select[name="selected_factory_id"]').val().trim();
		}
	}
	if(jQuery('select[name="selected_size_id"]').length > 0) {
		size_id = jQuery('select[name="selected_size_id"]').val().trim();
	}
	if(jQuery('select[name="selected_gsm_id"]').length > 0) {
		gsm_id = jQuery('select[name="selected_gsm_id"]').val().trim();
	}
	if(jQuery('select[name="selected_bf_id"]').length > 0) {
		bf_id = jQuery('select[name="selected_bf_id"]').val().trim();
	}
    
	var post_url = "view_bill_changes.php?stock_location_type="+location_type+"&stock_factory_id="+factory_id+"&stock_godown_id="+godown_id+"&stock_size_id="+size_id+"&stock_gsm_id="+gsm_id+"&stock_bf_id="+bf_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
			result = result.trim();
			if(result != "") {
				if (jQuery('.current_stock_span').length > 0) {
					jQuery('.current_stock_span').html(result);
				}
				if (jQuery('.current_stock_div').length > 0) {
					jQuery('.current_stock_div').removeClass('d-none');
				}
			}
        }
    });
}