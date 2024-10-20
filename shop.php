<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("./includes/meta&linkTags.php"); ?>
</head><!--/head-->

<body>
	<?php include("./includes/header.php"); ?>
	
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
			<?php include("./includes/sidebar.php"); ?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							include("./functions/connect.php");
							$select = "SELECT * FROM products";
							$cat = @$_GET["cat"] or null;
							$brand = @$_GET["brand"] or null;
							if(isset($cat)) $select .=" WHERE cat='$cat'";
							if(isset($brand)) $select .=" WHERE brand='$brand'";
							$pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
							foreach($pro as $v) {
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<a href="./product-details.php?id=<?= $v['id'] ?>">
										<img src="./admin/images/<?= explode(", ",$v['image'])[0] ?>"
										style="height: 250px !important;object-fit: contain;"
										alt="" />
										</a>
										<h2>$<?= $v['price'] ?></h2>
										<p><?= $v['name'] ?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<ul class="pagination" 
						style="width: 100%;display: flex !important;justify-content: center;">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>

	<?php include("./includes/footer.php"); ?>