<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			<?php 
			include("./functions/connect.php");
			$select = "SELECT * FROM category ORDER BY name";
			$pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
			foreach($pro as $v) {
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">
					<a href="shop.php?cat=<?= $v['id'] ?>"><?= $v['name'] ?></a>
				</h4>
				</div>
			</div>
			<?php } ?>
		</div><!--/category-products-->
	
		<div class="brands_products"><!--brands_products-->
			<h2>Brands</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					<?php 
					include("./functions/connect.php");
					$select = "SELECT * FROM brand ORDER BY name";
					$pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
					foreach($pro as $v) {
					$n = $conn->query("SELECT * FROM products WHERE brand=".$v['id'])->num_rows;
					?>
					<li>
					<a href="shop.php?brand=<?= $v['id'] ?>">
						<span class="pull-right">(<?= $n ?>)</span><?= $v['name'] ?>
					</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div><!--/brands_products-->
	
    </div>
  </div>