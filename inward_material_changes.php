<?php
	include("include_files.php");
	if(isset($_REQUEST['show_inward_material_id'])) { ?>
        <form class="poppins pd-20" name="organization_form" method="POST">
			<div class="card-header">
				<div class="row p-2">
					<div class="col-lg-8 col-md-8 col-8 align-self-center">
						<div class="h5">Add Inward Material</div>
					</div>
					<div class="col-lg-4 col-md-4 col-4">
						<button class="btn btn-dark float-end" style="font-size:11px;" type="button" onclick="window.open('inward_material.php','_self')"> <i class="fa fa-arrow-circle-o-left"></i> &ensp; Back </button>
					</div>
				</div>
			</div>
            <div class="row justify-content-center p-3">
                <input type="hidden" name="edit_id" value="<?php if(!empty($show_user_id)) { echo $show_user_id; } ?>">
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="date" id="name" name="name" class="form-control shadow-none" placeholder="" required>
                            <label>Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6 py-2 px-lg-1">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                            <label>Bill Number</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>Select Supplier</option>
                                    <option>Supplier 1</option>
                                    <option>Supplier 2</option>
                                </select>
                                <label>Select Supplier</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row justify-content-center p-3">
                <div class="col-lg-2 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option>Location</option>
                                <option>Godown</option>
                                <option>Factory</option>
                            </select>
                            <label>Select Location</label>
                        </div>
                    </div> 
                </div> 
                <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>Select Godown</option>
                                    <option>Godown 1</option>
                                    <option>Godown 2</option>
                                </select>
                                <label>Select Godown</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="name" name="name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                            <label>Factory Name</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>Select Reel Size</option>
                                    <option>120.5</option>
                                    <option>130.5</option>
                                </select>
                                <label>Select Reel Size</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>Select GSM</option>
                                    <option>120</option>
                                    <option>130</option>
                                </select>
                                <label>Select GSM</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border chargesaction">
                            <div class="input-group">
                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option>Select BF</option>
                                    <option>120.5</option>
                                    <option>130.5</option>
                                </select>
                                <label>Select BF</label>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color:#f06548!important; cursor:pointer; height:100%;"><i class="fa fa-plus text-white"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-3 col-6 px-lg-1 py-2">
                    <div class="form-group">
                        <div class="form-label-group in-border">
                            <input type="text" id="" name="" class="form-control shadow-none" onfocus="Javascript:KeyboardControls(this,'number',8,'');" placeholder="" required="">
                            <label>QTY</label>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1 col-md-2 col-6 px-lg-1  py-2">
                    <button class="btn btn-danger py-2" style="font-size:12px; width:100%;" type="button">  Add </button>
                </div>
            </div>
            <div class="row">    
                <div class="col-lg-12">
                    <div class="table-responsive text-center">
                        <table class="table nowrap cursor smallfnt w-100 table-bordered">
                            <thead class="bg-dark smallfnt">
                                <tr>
                                    <th>#</th>
                                    <th>Location</th>
                                    <th>Reel Size</th>
                                    <th>GSM</th>
                                    <th>BF</th>
                                    <th style="width:90px;">QTY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-label-group in-border chargesaction">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Godown</option>
                                                    <option>Godown 1</option>
                                                    <option>Godown 2</option>
                                                </select>
                                                <label>Select Godown</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <input type="text" id="name" name="name" class="form-control shadow-none" onkeydown="Javascript:KeyboardControls(this,'text',25,1);" placeholder="" required>
                                                <label>Factory Name</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-label-group in-border chargesaction">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select Reel Size</option>
                                                    <option>120.5</option>
                                                    <option>130.5</option>
                                                </select>
                                                <label>Select Reel Size</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-label-group in-border chargesaction">
                                                <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option>Select GSM</option>
                                                    <option>120</option>
                                                    <option>130</option>
                                                </select>
                                                <label>Select GSM</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-label-group in-border chargesaction">
                                                    <select class="select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option>Select BF</option>
                                                        <option>120.5</option>
                                                        <option>130.5</option>
                                                    </select>
                                                    <label>Select BF</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-label-group in-border">
                                                <input type="text" id="" name="" class="form-control shadow-none" style="width:90px;" onfocus="Javascript:KeyboardControls(this,'number',8,'');" required="">
                                            </div>
                                        </div> 
                                    </td>
                                    <td><a class="pe-2" href="#"><i class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            </tbody> 
                        </table>
                    </div>
                </div>
                <div class="col-md-12 py-3 text-center">
                    <button class="btn btn-danger" type="button">
                        Submit
                    </button>
                </div>
            </div>
            <script src="include/select2/js/select2.min.js"></script>
            <script src="include/select2/js/select.js"></script>
        </form>
		<?php
    } 
    if(isset($_POST['page_number'])) {
		$page_number = $_POST['page_number'];
		$page_limit = $_POST['page_limit'];
		$page_title = $_POST['page_title']; ?>
        
		<table class="table nowrap cursor text-center smallfnt">
            <thead class="bg-light">
                <tr>
                    <th>S.No</th>
                    <th>Date & Bill No</th>
                    <th>Supplier</th>
                    <th>Location</th>
                    <th>Reel Size</th>
                    <th>GSM</th>
                    <th>QTY</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>08-07-2025 & IW001</td>
                    <td>Supplier 1</td>
                    <td>Godown 1</td>
                    <td>150.2</td>
                    <td>170</td>
                    <td>10</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" class="btn btn-dark py-1 px-1" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>               
		<?php	
	}
    ?>