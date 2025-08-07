<?php
include("include_files.php");
?>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<table id="tbl_supplier_list" class="data-table table nowrap tablefont"
    style="margin: auto; width: 900px;display:none;">
    <thead class="thead-dark">
        <tr>
            <th>S.No</th>
            <th>Supplier Name</th>
            <th>Mobile Number</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $search_text = "";
        if (isset($_REQUEST['search_text'])) {
            $search_text = $_REQUEST['search_text'];
        }
       
        $total_records_list = array();
        $total_records_list = $obj->getTableRecords($GLOBALS['supplier_table'],'','','');
        
        if (!empty($search_text)) {
            $search_text = strtolower($search_text);
            $list = array();
            if (!empty($total_records_list)) {
                foreach ($total_records_list as $val) {
                    if ((strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_location'])), $search_text) !== false)) {
                        $list[] = $val;
                    }
                }
            }
            $total_records_list = $list;
        }

        if (!empty($total_records_list)) {
            foreach ($total_records_list as $key => $data) {
                $index = $key + 1; ?>
                <tr>
                    <td class="ribbon-header" style="cursor:default;"> <?php
                        echo $index; ?>
                    </td>
                    
                    <td> <?php
                        if(!empty($data['supplier_name']) && $data['supplier_name']!=$GLOBALS['null_value']) {
                            $data['supplier_name'] = $obj->encode_decode('decrypt', $data['supplier_name']);
                            echo $data['supplier_name'];
                        } ?>
                    </td>
                    <td> <?php
                        if(!empty($data['mobile_number']) && $data['mobile_number']!=$GLOBALS['null_value']) {
                            $data['mobile_number'] = $obj->encode_decode('decrypt', $data['mobile_number']);
                            echo $data['mobile_number'];
                        } ?>
                    </td>
                    <td> <?php
                        if(!empty($data['location']) && $data['location']!=$GLOBALS['null_value']) {
                            $data['location'] = $obj->encode_decode('decrypt', $data['location']);
                            echo $data['location'];
                        }else{
                            echo "-";
                        } ?>
                    </td>
                </tr>
            <?php }
        } ?>
    </tbody>
</table>

<script>
    ExportToExcel();
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_supplier_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        if (dl) {
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        } else {
            XLSX.writeFile(wb, fn || ('supplier_list.' + (type || 'xlsx')));
        }
        window.open("supplier.php", "_self");
    }
</script>