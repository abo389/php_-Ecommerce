<?php 
include("includes/template/header.php");
$offsit=0;
$limit = 6;

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

if(isset($_GET["offset"])) {
  $n = $_GET["offset"]-1;
  $offsit = $limit*$n;
}
if(isset($_GET["catId"]) && !empty($_GET["catId"])) {
  $catId = $_GET["catId"];
  $pro_nums = count($conn->query("SELECT * FROM products WHERE cat='$catId'")->fetch_all());
  $select = "SELECT * FROM products where cat='$catId' limit ".$limit." OFFSET ".$offsit;
} else {
  $select = "SELECT * FROM products limit ".$limit." OFFSET ".$offsit;
  $pro_nums = count($conn->query("SELECT * FROM products")->fetch_all());
}
// echo $pro_nums;
$all_pro = $conn->query($select)->fetch_all(MYSQLI_ASSOC);

?>

      <!--  Modal -->
      <?php
      foreach($all_pro as $pro) {
      $select_imgs = "SELECT * FROM images WHERE pro_id='$pro[id]'";
      $imgs = $conn->query($select_imgs)->fetch_all(MYSQLI_ASSOC);
      ?>
      <div class="modal fade" id="productView-<?=$pro["id"]?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="row align-items-stretch">
              
                <div class="col-lg-6 p-lg-0">
                  <a class="product-view d-block w-100 h-100 bg-cover bg-center"
                  style="background: url('admin/images/<?=$imgs[0]['name']?>');
                  background-size: contain !important;
                  background-repeat: no-repeat;" 
                  data-lightbox="productview" 
                  title="Red digital smartwatch"></a>
                </div>
                <div class="col-lg-6">
                  <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <div class="p-5 my-md-4">
                    <!-- stars -->
                    <ul class="list-inline mb-2">
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    </ul>
                    <h2 class="h4"><?=$pro["name"]?></h2>
                    <p class="text-muted">$<?=$pro["price"]?></p>
                    <p class="text-small mb-4"><?=$pro["description"]?></p>
                    <div class="row align-items-stretch mb-4">
                      <div class="col-sm-7 pr-sm-0">
                        <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                          <div class="quantity">
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" 
                      href="#">Add to cart</a></div>
                    </div><a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Shop</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
                <h5 class="text-uppercase mb-4">Categories</h5>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                  <?php
                  $select = "SELECT * FROM category";
                  $cat = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
                  foreach($cat as $c) {
                  ?>
                  <li class="mb-2"><a class="reset-anchor" href="shop.php?catId=<?=$c['id']?>"><?=$c['name']?></a></li>
                  <?php } ?>
                </ul>
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-small text-muted mb-0">Showing 1–6 of <?=$pro_nums?> results</p>
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                      <li class="list-inline-item">
                        <select class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                          <option value="default">Default sorting</option>
                          <option value="popularity">Popularity</option>
                          <option value="low-high">Price: Low to High</option>
                          <option value="high-low">Price: High to Low</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCT-->
                  <?php
                  foreach($all_pro as $pro) {
                  $select_imgs = "SELECT * FROM images WHERE pro_id='$pro[id]'";
                  $imgs = $conn->query($select_imgs)->fetch_all(MYSQLI_ASSOC);
                  if(isset($_SESSION["user_data"])) {
                    $href = "includes/functions/addToCart.php?p_id=".$pro['id']."&u_id=".$_SESSION["user_data"]["id"];
                  } else { $href= "cart.php";}
                  ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-"></div><a class="d-block" href="detail.php?id=<?=$pro["id"]?>"><img style="height: 250px;object-fit: contain;" class="img-fluid w-100" src="admin/images/<?=$imgs[0]['name']?>" alt="..."></a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" 
                            href="<?=$href?>">Add to cart</a></li>
                            <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView-<?=$pro["id"]?>" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="detail.php"><?=$pro["name"]?></a></h6>
                      <p class="small text-muted">$<?=$pro["price"]?></p>
                    </div>
                  </div>
                  <?php } ?>
                <!-- PAGINATION-->
              </div>
              <nav style="justify-self: center;" aria-label="Page navigation example">
                <ul class="pagination justify-content-center justify-content-lg-end">
                  <li><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                  <li class="page-item"><a class="page-link" href="shop.php?offset=1&catId=<?=$catId??""?>">1</a></li>
                  <li class="page-item"><a class="page-link" href="shop.php?offset=2&catId=<?=$catId??""?>">2</a></li>
                  <li class="page-item"><a class="page-link" href="shop.php?offset=3&catId=<?=$catId??""?>">3</a></li>
                  <li><a class="page-link" href="shop.php" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </section>
      </div>
      <!-- <script>
        let pageItems = document.getElementsByClassName("page-item");
        // console.log(pageItems[0]);
        for (let i = 0; i < pageItems.length; i++) {
          console.log(pageItems[i]);
          pageItems[i].addEventListener("click", () => {
            pageItems[i].classList.remove("active");
            pageItems[i].classList.add("active");
          })
        }
      </script> -->
      
<?php include("includes/template/footer.php"); ?>
