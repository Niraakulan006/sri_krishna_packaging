<button type="button" data-bs-toggle="modal" data-bs-target="#DeleteModal" class="d-none delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h5">Delete</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success yes"onClick="Javascript:confirm_delete_modal(this);">Yes</button>
                <button type="button" class="btn btn-danger no" onClick="Javascript:cancel_delete_modal(this);" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#AcknowledgementModal" class="d-none acknowledgement_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="AcknowledgementModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Invoice Acknowledgement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#clearancemodal" class="d-none clearance_modal_button"></button>
<div class="modal fade" id="clearancemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Parcel Receiving Person Details</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('clearance_form', 'clearance_entry_changes.php', 'clearance_entry.php');">Submit</button>
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#ReceiptDeleteModal" class="d-none receipt_delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ReceiptDeleteModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close d-none" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            Modal body..
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_receipt_delete_modal(this);">Yes</button>
            <button type="button" class="btn btn-danger no" onClick="Javascript:cancel_delete_modal(this);">No</button>
        </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#PreviewUpdateModal" class="d-none preview_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PreviewUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#RemarksUpdateModal" class="d-none remarks_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="RemarksUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_delete_receipt_modal(this);">Submit</button>
            </div>
        </div>
    </div>
</div>
<button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="d-none alert_modal_button"></button>
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Alert!!!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#CustomPartyModal" class="d-none custom_party_modal_button"></button>
<!-- The Modal -->
<div class="modal modal-xl fade" id="CustomPartyModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Create Supplier</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body px-0">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#ViewBillModal" class="d-none view_bill_modal_button"></button>
<!-- The Modal -->
<div class="modal modal-lg fade" id="ViewBillModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Reels in this Bill</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body px-0">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#PendingQtyModal" class="d-none pending_qty_modal_button"></button>
<!-- The Modal -->
<div class="modal modal-lg fade" id="PendingQtyModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Pending Qty</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body px-0">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#ScanBarcodeModal" class="d-none scan_barcode_modal_button"></button>
<!-- The Modal -->
<div class="modal modal-lg fade" id="ScanBarcodeModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Scan Barcode</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body px-0">
                <div id="reader"></div>
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#BillModal" class="d-none bill_modal_button"></button>

<div class="modal fade" id="BillModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <!-- Content will be inserted dynamically -->
            </div>
        </div>
    </div>
</div>


