<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>
            <li class="active">Worker</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Worker</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>
                <div class="div-action pull pull-left" style="padding-bottom: 20px;">
                    <form method="POST" action="workerscsv.php">
                        <input type="submit" name="export" value="CSV Export" class="btn btn-success" />
                    </form>
                </div>
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addWorkerModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Worker </button>
                </div> <!-- /div-action -->

                <table class="table" id="manageWorkerTable">
                    <thead>
                        <tr>
                            <th>Worker Name</th>
                            <th>Worker Contact Information</th>
                            <th>Worker Category</th>
                            <th>Status</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addWorkerModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitWorkerForm" action="php_action/createWorker.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Worker</h4>
                </div>
                <div class="modal-body">

                    <div id="add-worker-messages"></div>

                    <div class="form-group">
                        <label for="workerName" class="col-sm-3 control-label">Worker Name: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="workerName" placeholder="Worker Name" name="workerName" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="workerContact" class="col-sm-3 control-label">Worker Contact </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="workerContact" placeholder="Worker Contact" name="workerContact" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

					<div class="form-group">
						<label for="workerCategory" class="col-sm-3 control-label">Worker Category: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select type="text" class="form-control" id="workerCategory" placeholder="Worker Category" name="workerCategory">
								<option value="">~~SELECT~~</option>
								<?php
								$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
								$result = $connect->query($sql);

								while ($row = $result->fetch_array()) {
									echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
								} // while

								?>
							</select>
						</div>
					</div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="workerStatus" class="col-sm-3 control-label">Status: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="workerStatus" name="workerStatus">
                                <option value="">~~SELECT~~</option>
                                <option value="1">Active</option>
                                <option value="2">Emergency Leave</option>
                                <option value="3">On Holiday</option>
                            </select>
                        </div>
                    </div> <!-- /form-group-->

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary" id="createWorkerBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit worker -->
<div class="modal fade" id="editWorkerModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editWorkerForm" action="php_action/editWorker.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Worker</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-worker-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-worker-result">

                        <div class="form-group">
                            <label for="editWorkerName" class="col-sm-3 control-label">Worker Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editWorkerName" placeholder="Worker Name" name="editWorkerName" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="editWorkerContact" class="col-sm-3 control-label">Worker Contact: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editWorkerContact" placeholder="Worker Contact" name="editWorkerContact" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
						<label for="editWorkerCategory" class="col-sm-3 control-label">Worker Category: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select type="text" class="form-control" id="editWorkerCategory" placeholder="Worker Category" name="editWorkerCategory">
								<option value="">~~SELECT~~</option>
								<?php
								$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
								$result = $connect->query($sql);

								while ($row = $result->fetch_array()) {
									echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
								} // while

								?>
							</select>
						</div>
					</div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="editWorkerStatus" class="col-sm-3 control-label">Status: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editWorkerStatus" name="editWorkerStatus">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Active</option>
                                    <option value="2">Emergency Leave</option>
                                    <option value="3">On Holiday</option>
                                </select>
                            </div>
                        </div> <!-- /form-group-->
                    </div>
                    <!-- /edit worker result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editWorkerFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                    <button type="submit" class="btn btn-success" id="editWorkerBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit worker -->

<!-- remove worker -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Worker</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeWorkerFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeWorkerBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove worker -->

<script src="custom/js/workers.js"></script>

<?php require_once 'includes/footer.php'; ?>