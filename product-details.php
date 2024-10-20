<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("./includes/meta&linkTags.php"); ?>
</head><!--/head-->

<body>
	<?php include("./includes/header.php"); ?>
	
	<section>
		<div class="container">
			<div class="row">
				<?php include("./includes/sidebar.php"); ?>
				
				<div class="col-sm-9 padding-right">
					<?php
						include("./functions/connect.php");
						$id = $_GET["id"];
						$conn->query("UPDATE `products` SET views=views+1 WHERE id='$id'");
						$select = "SELECT * FROM products WHERE id='$id'";
						$pro = $conn->query($select)->fetch_assoc();
					?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="./admin/images/<?= explode(", ",$pro['image'])[0] ?>"
								style="object-fit: contain;"
								alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
						    <!-- Wrapper for slides -->
						    <div class="carousel-inner">
                
                <?php 
                  $imgs = explode( ", ", $pro["image"]);
                  $n = 0;
                  for ($i=0; $i < count($imgs) / 3; $i++) { ?>
                    <div class="item <?= $i == 0 ? "active":"" ?>">
                      <?php for ($j=0; $j <= 2; $j++) { 
                        if(isset($imgs[$n])) {
                          echo "<img 
                          style='height: 80px;object-fit: contain;'
                          src='./admin/images/$imgs[$n]'>";
                        }
                      $n++;} ?>
                    </div>
                  <?php } ?>
							  </div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?= $pro['name'] ?></h2>
								<p>Web ID: 1089772<?= $pro['id'] ?></p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>US $<?= $pro['price'] ?></span>
									<label>Quantity:</label>
									<input type="text" value="<?= $pro['count'] ?>" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> <?= ($pro['count'] > 0) ? "In":"out of" ?> Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>views: </b> <?= $pro["views"] ?> </p>
								<?php
								$brandId = $pro["brand"];
								$brand = $conn->query("SELECT * FROM brand WHERE id='$brandId'")->fetch_assoc();
								?>
								<p><b>Brand:</b> <?= $brand['name'] ?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<div><?= $pro['description'] ?></div>
					
				</div>
			</div>
		</div>
	</section>
	
	<?php include("./includes/footer.php"); ?>