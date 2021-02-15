<?php require_once 'includes/header.php'; ?>

<?php

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$orderSql = "SELECT * FROM orders WHERE payment_status = 3";
$orderQuery = $connect->query($orderSql);
$countOrderDebtors = $orderQuery->num_rows;

$sorderSql = "SELECT * FROM orders WHERE payment_status = 2";
$sorderQuery = $connect->query($sorderSql);
$countOrderCreditors = $sorderQuery->num_rows;

$countTaskSql = "SELECT * FROM tasks WHERE active > 1";
$countTaskQuery = $connect->query($countTaskSql);
$countIncompleteTasks = $countTaskQuery->num_rows;

//i want to get the sum of the amounts in my expenses table and then display it in a card down where you see $totalRevenue.
$expenseSql = "SELECT SUM(expense_amount) AS ExpenseTotal FROM expenses";
$expenseQuery = $connect->query($expenseSql);
$totalExpense = 0;
while ($expenseResult = $expenseQuery->fetch_assoc()) {
	$totalExpense += $expenseResult['ExpenseTotal'];
}
$profit = $totalRevenue - $totalExpense;





$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 1) { ?>
		<div class="col-md-2">
			<div class="panel panel-success">
				<div class="panel-heading">

					<a href="product.php" style="text-decoration:none;color:black;">
						Total Product
						<span class="badge pull pull-right"><?php echo $countProduct; ?></span>
					</a>

				</div>
				<!--/panel-hdeaing-->
			</div>
			<!--/panel-->
		</div>
		<!--/col-md-4-->

		<div class="col-md-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<a href="product.php" style="text-decoration:none;color:black;">
						Low Stock
						<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>
					</a>

				</div>
				<!--/panel-hdeaing-->
			</div>
			<!--/panel-->
		</div>
		<!--/col-md-4-->


	<?php } ?>
	<div class="col-md-2">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Orders
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>

			</div>
			<!--/panel-hdeaing-->
		</div>
		<!--/panel-->
	</div>
	<!--/col-md-4-->

	<div class="col-md-2">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="tasks.php" style="text-decoration:none;color:black;">
					Incomplete Tasks 
					<span class="badge pull pull-right"><?php echo $countIncompleteTasks; ?></span>
				</a>

			</div>
			<!--/panel-hdeaing-->
		</div>
		<!--/panel-->
	</div>


	<div class="col-md-2">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Debtors
					<span class="badge pull pull-right"><?php echo $countOrderDebtors; ?></span>
				</a>

			</div>
			<!--/panel-hdeaing-->
		</div>
		<!--/panel-->
	</div>
	<!--/col-md-4-->

	<div class="col-md-2">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Creditors
					<span class="badge pull pull-right"><?php echo $countOrderCreditors; ?></span>
				</a>

			</div>
			<!--/panel-hdeaing-->
		</div>
		<!--/panel-->
	</div>
	<!--/col-md-4-->
	



	<div class="col-md-6">
		<div class="card">
			<div class="cardHeader">
				<h1><?php echo date('d'); ?></h1>
			</div>

			<div class="cardContainer">
				<p><?php echo date('l') . ' ' . date('d') . ', ' . date('Y'); ?></p>
			</div>
		</div>
		<br />

		<div class="card">
			<div class="cardHeader" style="background-color:#245580;">
				<h1><?php if ($totalRevenue) {
						echo $totalRevenue;
					} else {
						echo '0';
					} ?></h1>
			</div>

			<div class="cardContainer">
				<p>Total Revenue(UGX)</p>
			</div>
		</div>
		</br>

		<div class="card">
			<div class="cardHeader" style="background-color:#248780;">
				<h1><?php if ($totalExpense) {
						echo $totalExpense;
					} else {
						echo '0';
					} ?></h1>
			</div>

			<div class="cardContainer">
				<p>Total Expense (UGX)</p>
			</div>
		</div>

		<!-- <div class="card">
			<div class="cardHeader" style="background-color:#248780;">
				<h1><?php if ($profit > 0) {
						echo $profit;
					} else {
						echo $profit;
					} ?></h1>
			</div>

			<div class="cardContainer">
				<p>Profit</p>
			</div>
		</div> -->

	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="cardHeader" style="background-color:#248780;">
				<h1><?php if ($profit > 0) {
						echo $profit;
					} else {
						echo $profit;
					} ?></h1>
			</div>

			<div class="cardContainer">
				<p>Profit</p>
			</div>
		</div>

	</div>
</div>
<!--/row-->


<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function() {
		// top bar active
		$('#navDashboard').addClass('active');

		//Date for the calendar events (dummy data)
		var date = new Date();
		var d = date.getDate(),
			m = date.getMonth(),
			y = date.getFullYear();

		$('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title'
			},
			buttonText: {
				today: 'today',
				month: 'month'
			}
		});


	});
</script>

<?php require_once 'includes/footer.php'; ?>