<?php 
session_start();
if(!isset($_SESSION["login"])) header("location:index.php");
$status = "products";
include("./includes/navbar.php");
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">products</li>
			</ol>
	</div><!--/.row-->

    <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">products</h1>
			</div>
		</div><!--/.row-->


    <?php
    if($_GET) $action = $_GET["action"];
    if(!isset($action)) include("./productsPage/all_product.php");
    elseif($action === "add") include("./productsPage/add_product.php");
    elseif($action === "edit") include("./productsPage/edit_product.php");
    ?>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
	window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
