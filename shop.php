<?php include("includes/template/header.php"); ?>

      <!--  Modal -->
      <div id="modal-container"></div>
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
                <ul id="cat-list" class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                </ul>
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-small text-muted mb-0">Showing 1–6 of <b id="total-items"></b> results</p>
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                      <li class="list-inline-item">
                        <select id="sortSelect" class="selectpicker ml-auto" name="sorting" data-width="200" data-style="select-form-control" data-title="Default sorting">
                          <option value="default">Default sorting</option>
                          <option value="asc">Price: Low to High</option>
                          <option value="desc">Price: High to Low</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="product-container" class="row">
                </div>
                <!-- PAGINATION-->
              <nav style="justify-self: center;" aria-label="Page navigation example">
                <ul id="pagination-list" class="pagination justify-content-center justify-content-lg-end">
                </ul>
              </nav>
            </div>
          </div>
        </section>
      </div>
      
<?php include("includes/template/footer.php"); ?>
