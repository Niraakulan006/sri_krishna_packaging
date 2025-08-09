<input type="hidden" name="show_cancel_<?php echo $id; ?>" value="<?php echo $cancelled; ?>">
<div class="table-responsive" style="height:800px; overflow-y:scroll!important;">
    <table id="<?php echo $id; ?>" class="datatable table nowrap border cursor text-center smallfnt table-bordered">
        <thead class="bg-light">
            <tr>
                <th style="min-width:75px;">S.No</th>
                <th style="min-width:100px;">Bill Date</th>
                <th style="min-width:100px;">Delivery Slip No</th>
                <th style="min-width:100px;">Request No</th>
                <th style="min-width:200px;">Godown</th>
                <th style="min-width:75px;">Reel Count</th>
                <th style="min-width:75px;">View</th>
                <th style="min-width:75px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
