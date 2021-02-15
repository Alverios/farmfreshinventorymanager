<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">Task</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Task</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
				<div class="div-action pull pull-left" style="padding-bottom: 20px;">
                    <form method="POST" action="taskscsv.php">
                        <input type="submit" name="export" value="CSV Export" class="btn btn-success" />
                    </form>
                </div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addTaskModalBtn" data-target="#addTaskModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Task </button>
				</div> <!-- /div-action -->

				<table class="table" id="manageTaskTable">
					<thead>
						<tr>
							<th>Task Date</th>
							<th>Worker Assigned</th>
							<th>Task Description</th>
							<th>Completion Rate</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitTaskForm" action="php_action/createTask.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Task</h4>
				</div>

				<div class="modal-body" style="max-height:450px; overflow:auto;">

					<div id="add-task-messages"></div>

					<div class="form-group">
						<label for="taskDate" class="col-sm-3 control-label">Task Date: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="taskDate" placeholder="yyyy-mm-dd" name="taskDate" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="taskDesc" class="col-sm-3 control-label">Task Description: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="taskDesc" placeholder="Task Description" name="taskDesc" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="workerName" class="col-sm-3 control-label">Assigned To: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select type="text" class="form-control" id="workerName" placeholder="Assigned To" name="workerName">
								<option value="">~~SELECT~~</option>
								<?php
								$sql = "SELECT worker_id, worker_name, worker_active, worker_status FROM employees WHERE worker_status = 1 AND worker_active = 1";
								$result = $connect->query($sql);

								while ($row = $result->fetch_array()) {
									echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
								} // while

								?>
							</select>
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="taskStatus" class="col-sm-3 control-label">Completion Rate: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select class="form-control" id="taskStatus" name="taskStatus">
								<option value="">~~SELECT~~</option>
								<option value="1">Complete</option>
								<option value="2">Half way Done</option>
								<option value="3">No Work Done</option>
							</select>
						</div>
					</div> <!-- /form-group-->
				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="submit" class="btn btn-primary" id="createTaskBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div> <!-- /modal-footer -->
			</form> <!-- /.form -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->
</div>
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Task</h4>
			</div>
			<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>

				<div class="div-result">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<!-- <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li> -->
						<li role="presentation"><a href="#taskInfo" aria-controls="profile" role="tab" data-toggle="tab">Task Info</a></li>
					</ul>

					-->
					<div role="tabpanel" class="tab-pane" id="taskInfo">
						<form class="form-horizontal" id="editTaskForm" action="php_action/editTask.php" method="POST">
							<br />

							<div id="edit-task-messages"></div>

							<div class="form-group">
								<label for="editTaskDate" class="col-sm-3 control-label">Task Name: </label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="editTaskDate" placeholder=" Edit Task Name" name="editTaskDate" autocomplete="off">
								</div>
							</div> <!-- /form-group-->

							<div class="form-group">
								<label for="editTaskDesc" class="col-sm-3 control-label">Task Description: </label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="editTaskDesc" placeholder=" Edit Task Description" name="editTaskDesc" autocomplete="off">
								</div>
							</div> <!-- /form-group-->

							<div class="form-group">
								<label for="editWorkerName" class="col-sm-3 control-label"> Assigned To: </label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-8">
									<select type="text" class="form-control" id="editWorkerName" name="editWorkerName">
										<option value="">~~ASSIGN TO~~</option>
										<?php
										$sql = "SELECT worker_id, worker_name, worker_active, worker_status FROM employees WHERE worker_status = 1 AND worker_active = 1";
										$result = $connect->query($sql);

										while ($row = $result->fetch_array()) {
											echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
										} // while

										?>
									</select>
								</div>
							</div> <!-- /form-group-->

							<div class="form-group">
								<label for="editTaskStatus" class="col-sm-3 control-label">Completion Rate: </label>
								<label class="col-sm-1 control-label">: </label>
								<div class="col-sm-8">
									<select class="form-control" id="editTaskStatus" name="editTaskStatus">
										<option value="">~~SELECT~~</option>
										<option value="1">Complete</option>
										<option value="2">Half way Done</option>
										<option value="3">No Work Done</option>
									</select>
								</div>
							</div> <!-- /form-group-->

							<div class="modal-footer editTaskFooter">
								<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

								<button type="submit" class="btn btn-success" id="editTaskBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
							</div> <!-- /modal-footer -->
						</form> <!-- /.form -->
					</div>
					<!-- /task info -->
				</div>

			</div>

		</div> <!-- /modal-body -->


	</div>
	<!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeTaskModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Task</h4>
			</div>
			<div class="modal-body">

				<div class="removeTaskMessages"></div>

				<p>Do you really want to remove ?</p>
			</div>
			<div class="modal-footer removeTaskFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removeTaskBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/task.js"></script>

<?php require_once 'includes/footer.php'; ?>