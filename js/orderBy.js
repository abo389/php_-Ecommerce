const productContainer = $( "#product-container" );
const totalProducts = $( "#total-items" );
const pagination = $( "#pagination-list" );
const sortSelect = $( "#sortSelect" );
const categoryList = $( "#cat-list" );
const modals = $( "#modal-container" );

// console.log(localStorage.getItem("user_data"))


let url = ["api/api.php/products?","","",""];

$.get( url.join(""), ( res ) =>
{
  // console.log(res)
  showProducts( res.items );
  paginationfn(res.total_items, res.total_pages)
  sorting()
  categoryFilter()
} );


function showProducts ( arr )
{
  if ( localStorage.getItem( "user_data" ) != null )
  {
    var userData = localStorage.getItem( "user_data" ).split(",") 
  }

  productContainer.html( arr.map( ( pro ) =>
    {
      let images = pro.image.split( ", " );
      return `
      <div class="col-lg-4 col-sm-6">
        <div class="product text-center">
          <div class="mb-3 position-relative">
            <div class="badge text-white badge-"></div>
            <a class="d-block" href="detail.php?id=${pro.id}">
              <img style="height: 250px;object-fit: contain;" class="img-fluid w-100" src="admin/images/${images[0]}" alt="...">
            </a>
            <div class="product-overlay">
              <ul class="mb-0 list-inline">
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" 
                href="${userData ? `includes/functions/addToCart.php?p_id=${pro.id}&u_id=${userData[0]}`:`cart.php`}">Add to cart</a></li>
                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView-${pro.id}" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
              </ul>
            </div>
          </div>
          <h6> <a class="reset-anchor" href="detail.php">${pro.name}</a></h6>
          <p class="small text-muted">$${pro.price}</p>
        </div>
      </div>
      `
  } ) )
  modals.html( arr.map( ( pro ) =>
  {
    let images = pro.image.split( ", " );
    return `
      <div class="modal fade" id="productView-${pro.id}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="row align-items-stretch">
              
                <div class="col-lg-6 p-lg-0">
                  <a class="product-view d-block w-100 h-100 bg-cover bg-center"
                  style="background: url('admin/images/${images[0]}');
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
                    <h2 class="h4">${pro.name}</h2>
                    <p class="text-muted">$${pro.price}</p>
                    <p class="text-small mb-4">${pro.description}</p>
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
                      href="${userData ? `includes/functions/addToCart.php?p_id=${pro.id}&u_id=${userData[0]}`:`cart.php`}">Add to cart</a></div>
                    </div><a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  }))
}

function paginationfn (totalItems, totalPages)
{
  let paginationHtml = "";
  totalProducts.html(totalItems)
  for ( let i = 0; i < totalPages; i++ )
    {
      paginationHtml += `<li class="page-item">
                        <a href="#" class="page-link" id="${i+1}">
                        ${i+1}
                        </a>
                      </li>`
    }
  pagination.html( paginationHtml )
  const pageLinks = $( ".page-link" );
  for (let j = 0; j < pageLinks.length; j++) {
    pageLinks[ j ].onclick = (e) =>
    {
      e.preventDefault()
      url[ 1 ] = "&page=" + pageLinks[ j ].id;
      // console.log(url)
      $.get(url.join(""),(res) => showProducts(res.items))
    }
  }
}

function sorting ()
{
  sortSelect.change( function ()
  {
    let value = sortSelect.val();
    if ( value === "default" ) value = null;
    url[ 3 ] = "&sort=" + value;
    // console.log(url)
    $.get(url.join(""),(res) => showProducts(res.items))
  })
}

function categoryFilter ()
{
  $.get( "api/api.php/category", ( r ) =>
  {
    // console.log( r );
    let catHtml = "";
    for (let k = 0; k < r.length; k++) {
      catHtml += `
                  <li class="mb-2">
                    <a class="reset-anchor cat-link" id="${r[k].id}" href="#">
                      ${r[k].name}
                    </a>
                  </li>
      `
    }
    categoryList.html( catHtml )
    const catLinks = $( ".cat-link" )
    for (let i = 0; i < catLinks.length; i++) {
      catLinks[ i ].onclick = (e) =>
        {
        e.preventDefault()
        url[ 1 ] = "";
        url[ 2 ] = "&category_id=" + catLinks[ i ].id
        // console.log(url)
        $.get( url.join("") , ( res ) =>
        {
          // console.log( res );
          showProducts( res.items );
          paginationfn(res.total_items, res.total_pages)
        } )
        }
    }
  } )
}