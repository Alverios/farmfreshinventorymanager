<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">Expense</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Expense</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
				<div class="div-action pull pull-left" style="padding-bottom: 20px;">
                    <form method="POST" action="expensecsv.php">
                        <input type="submit" name="export" value="CSV Export" class="btn btn-success" />
                    </form>
                </div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addExpenseModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Expense </button>
				</div> <!-- /div-action -->

				<table class="table" id="manageExpenseTable">
					<thead>
						<tr>
							<th>Date</th>
							<th>Expense Name</th>
							<th>Expense Category</th>
							<th>Expense Amount</th>
							<th>Payment Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addExpenseModel" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitExpenseForm" action="php_action/createExpense.php" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Expense</h4>
				</div>
				<div class="modal-body">

					<div id="add-expense-messages"></div>

					<div class="form-group">
						<label for="expenseDate" class="col-sm-3 control-label">Date: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="expenseDate" placeholder="yyyy-mm-dd" name="expenseDate" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="expenseName" class="col-sm-3 control-label">Expense Name: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="expenseName" placeholder="Expense Name" name="expenseName" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="expenseCategory" class="col-sm-3 control-label">Expense Category: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select type="text" class="form-control" id="expenseCategory" placeholder="Expense Category" name="expenseCategory">
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
						<label for="expenseAmount" class="col-sm-3 control-label">Expense Amount </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="expenseAmount" placeholder="Expense Amount" name="expenseAmount" autocomplete="off">
						</div>
					</div> <!-- /form-group-->
					<div class="form-group">
						<label for="expenseStatus" class="col-sm-3 control-label">Status: </label>
						<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select class="form-control" id="expenseStatus" name="expenseStatus">
								<option value="">~~SELECT~~</option>
								<option value="1">Full Payment</option>
								<option value="2">Partial Payment</option>
								<option value="3">No Payment</option>
							</select>
						</div>
					</div> <!-- /form-group-->

				</div> <!-- /modal-body -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-primary" id="createExpenseBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
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

<!-- edit expense -->
<div class="modal fade" id="editExpenseModel" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="editExpenseForm" action="php_action/editExpense.php" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Expense</h4>
				</div>
				<div class="modal-body">

					<div id="edit-expense-messages"></div>

					<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

					<div class="edit-expense-result">

						<div class="form-group">
							<label for="editExpenseDate" class="col-sm-3 control-label">Date: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="editExpenseDate" placeholder="yyyy-mm-dd" name="editExpenseDate" autocomplete="off">
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="editExpenseName" class="col-sm-3 control-label">Expense Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="editExpenseName" placeholder="Expense Name" name="editExpenseName" autocomplete="off">
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="editExpenseCategory" class="col-sm-3 control-label">Expense Category: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select type="text" class="form-control" id="editExpenseCategory" placeholder="Worker Category" name="editExpenseCategory">
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
							<label for="editExpenseAmount" class="col-sm-3 control-label">Expense Amount: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="editExpenseAmount" placeholder="Expense Amount" name="editExpenseAmount" autocomplete="off">
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="editExpenseStatus" class="col-sm-3 control-label">Status: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select class="form-control" id="editExpenseStatus" name="editExpenseStatus">
									<option value="">~~SELECT~~</option>
									<option value="1">Full Payment</option>
									<option value="2">Partial Payment</option>
									<option value="3">No Payment</option>
								</select>
							</div>
						</div> <!-- /form-group-->
					</div>
					<!-- /edit expense result -->

				</div> <!-- /modal-body -->

				<div class="modal-footer editExpenseFooter">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="submit" class="btn btn-success" id="editExpenseBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
<!-- /edit expense -->

<!-- remove expense -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Expense</h4>
			</div>
			<div class="modal-body">
				<p>Do you really want to remove ?</p>
			</div>
			<div class="modal-footer removeExpenseFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removeExpenseBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove expense -->

<script src="custom/js/expense.js"></script>

<?php require_once 'includes/footer.php'; ?>