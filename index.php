<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/meta&linkTags.php"); ?>
</head><!--/head-->

<body>
	
	<?php include("./includes/header.php"); ?>
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<?php 
								include("./functions/connect.php");
								$select = "SELECT * FROM products LIMIT 3";
								$pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
								// echo "<pre>";
								// print_r($pro);
								// echo "</pre>";
								$c = 0;
								foreach($pro as $v) {
									$c++;
								?>
								<div class="item <?= ($c == 1) ? "active" : "" ?>">
									<div class="col-sm-6">
										<h1><span>E</span>-SHOPPER</h1>
										<h2><?= $v['name'] ?></h2>
										<p><?= substr($v['description'],0,30) ?> </p>
										<button type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
									<a href="./product-details.php?id=<?= $v['id'] ?>">
										<img style="height: 400px !important;object-fit: contain;" 
										src="./admin/images/<?= $v['image'] ?>" class="girl img-responsive" alt="" />
									</a>
									</div>
								</div>
								<?php } ?>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<?php include("./includes/sidebar.php"); ?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							
							include("./functions/connect.php");
							$select = "SELECT * FROM products LIMIT 6";
							$pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
							foreach($pro as $v) {
							?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
											<a href="./product-details.php?id=<?= $v['id'] ?>">
												<img style="height: 250px !important;object-fit: contain;"
													src="./admin/images/<?= $v['image'] ?>" alt="" />
											</a>
												<h2><?= $v['price'] ?></h2>
												<p><?= $v['name'] ?></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
										</ul>
									</div>
								</div>
							</div>

							<?php } ?>
						
					</div><!--features_items-->
					
					
				</div>
			</div>
		</div>
	</section>
	
	<?php include("./includes/footer.php"); ?>