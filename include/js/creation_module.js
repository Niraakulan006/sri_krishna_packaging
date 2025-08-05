function SnoCalculation() {
    if (jQuery('.sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}

var regex = /^[a-zA-Z][a-zA-Z\s&@.,\-']+$/;

function addCreationDetails(name, characters) {
    var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                var creation_name = "";
                var format = regex;
                var name_variable = "";

                

                name_variable = name.toLowerCase();
                name_variable = name_variable.trim();
                name_variable = name_variable.replace("_", " ");
                if (jQuery('input[name="' + name + '_name"]').is(":visible")) {
                    if (jQuery('input[name="' + name + '_name"]').length > 0) {
                        creation_name = jQuery('input[name="' + name + '_name"]').val();
                        creation_name = creation_name.trim();
                        creation_name = creation_name.replace('&', "@@@");
                        if(creation_name == 'size' || creation_name == 'bf'){
                            format = '/\d+(\.\d+)?\s*"/g';
                        }
                        if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0 || creation_name == null) {
                            all_errors_check = 0;
                        }
                        else if (format.test(creation_name) == false) {
                            letters_check = 0;
                        }
                        else if (creation_name.length > parseInt(characters)) {
                            error = 0;
                        }
                    }
                }
                if (parseInt(all_errors_check) == 1) {
                    if (parseInt(letters_check) == 1 || name == "gsm" || name == "size" || name == "bf") {
                        if (parseInt(error) == 1) {
                            var add = 1;
                            if (creation_name != "") {
                                if (jQuery('input[name="' + name + '_names[]"]').length > 0) {
                                    jQuery('.added_' + name + '_table tbody').find('tr').each(function () {
                                        var prev_creation_name = jQuery(this).find('input[name="' + name + '_names[]"]').val().toLowerCase();
                                        var current_creation_name = creation_name.toLowerCase();
                                        if (prev_creation_name == current_creation_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }
                            if (add == 1) {
                                var count = jQuery('input[name="' + name + '_count"]').val();
                                count = parseInt(count) + 1;
                                jQuery('input[name="' + name + '_count"]').val(count);
                                var post_url = name + "_changes.php?" + name + "_row_index=" + count + "&selected_" + name + "_name=" + creation_name;
                                jQuery.ajax({
                                    url: post_url, success: function (result) {
                                        if (jQuery('.added_' + name + '_table tbody').find('tr').length > 0) {
                                            jQuery('.added_' + name + '_table tbody').find('tr:first').before(result);
                                        }
                                        else {
                                            jQuery('.added_' + name + '_table tbody').append(result);
                                        }
                                        if (jQuery('input[name="' + name + '_name"]').length > 0) {
                                            jQuery('input[name="' + name + '_name"]').val('').focus();
                                        }
                                        SnoCalculation();
                                    }
                                });
                            }
                            else {
                                jQuery('.added_' + name + '_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This ' + name_variable + ' already Exists</div>');
                            }
                        }
                        else {
                            jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Only ' + characters + ' Characters allowed</div>');
                        }
                    }
                    else {
                        jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;color:red;">Invalid Characters</div>');
                        jQuery('input[name="' + name + '_name"]').val('');
                    }
                }
                else {
                    jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check field values</div>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}
function DeleteCreationRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + '_row' + row_index).length > 0) {
                    jQuery('#' + id_name + '_row' + row_index).remove();
                }
                SnoCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}
function addCreationFormDetails(name, characters) {
    var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                var creation_name = "";
                var format = regex;
                if (name == 'film_size' || name == 'film_micron') {
                    format = number_regex;
                }
                var name_variable = "";
                name_variable = name.toLowerCase();
                name_variable = name_variable.trim();
                name_variable = name_variable.replace("_", " ");
                if (jQuery('input[name="' + name + '_name"]').is(":visible")) {
                    if (jQuery('input[name="' + name + '_name"]').length > 0) {
                        var creation_name = "";
                        if (jQuery('input[name="' + name + '_name"]').length > 0) {
                            creation_name = jQuery('input[name="' + name + '_name"]').val();
                            creation_name = jQuery.trim(creation_name);
                            if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0) {
                                all_errors_check = 0;
                                showerrormsg(name + '_name', 'input', 'Godown Name', name + '_form');
                            }
                        }

                        var creation_location = "";
                        if (jQuery('input[name="' + name + '_location"]').length > 0) {
                            creation_location = jQuery('input[name="' + name + '_location"]').val();
                            creation_location = jQuery.trim(creation_location);
                            if (typeof creation_location == "undefined" || creation_location == "" || creation_location == 0) {
                                all_errors_check = 0;
                                showerrormsg(name + '_location', 'input', 'Godown Location', name + '_form');
                            }
                        }
                        // if (parseInt(all_errors_check) == 1 && parseInt(letters_check) == 1 && parseInt(error) == 1) {
                        if (parseInt(all_errors_check) == 1) {
                            var add = 1;
                            if (creation_name != "") {
                                if (jQuery('input[name="' + name + '_names[]"]').length > 0) {
                                    jQuery('.added_' + name + '_table tbody').find('tr').each(function () {
                                        var prev_creation_name = jQuery(this).find('input[name="' + name + '_names[]"]').val().toLowerCase();
                                        var current_creation_name = creation_name.toLowerCase();
                                        if (prev_creation_name == current_creation_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }

                            if (add == 1) {
                                var count = parseInt(jQuery('input[name="' + name + '_count"]').val()) + 1;
                                jQuery('input[name="' + name + '_count"]').val(count);

                                jQuery.ajax({
                                    url: name + "_changes.php",
                                    type: "POST",
                                    data: {
                                        [name + "_row_index"]: count,
                                        ["selected_" + name + "_name"]: creation_name,
                                        ["selected_" + name + "_location"]: creation_location
                                    },
                                    success: function (result) {
                                        var tbody = jQuery('.added_' + name + '_table tbody');
                                        if (tbody.find('tr').length > 0) {
                                            tbody.find('tr:first').before(result);
                                        } else {
                                            tbody.append(result);
                                        }
                                        jQuery('input[name="' + name + '_name"]').val('').focus();
                                        jQuery('input[name="' + name + '_location"]').val('');
                                        SnoCalculation();
                                    }
                                });
                            } else {
                                jQuery('.added_' + name + '_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This ' + name_variable + ' already Exists</div>');
                            }
                        } else {
                            jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Only ' + characters + ' Characters allowed or invalid data</div>');
                        }
                    }
                }
                else {
                    jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check all field values</div>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function show_sub_unit(raw_material_type) {
    if (raw_material_type == "3") {
        if ($("select[name='sub_unit_id']").length > 0) {
            $("select[name='sub_unit_id']").addClass("d-none")
        }
        if ($("input[name='sub_unit_contains']").length > 0) {
            $("input[name='sub_unit_contains']").addClass("d-none")
        }
    }
    else {
        if ($("select[name='sub_unit_id']").length > 0) {
            $("select[name='sub_unit_id']").removeClass("d-none")
        }
        if ($("input[name='sub_unit_contains']").length > 0) {
            $("input[name='sub_unit_contains']").removeClass("d-none")
        }
    }
}