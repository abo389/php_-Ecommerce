const cartBody = $( "#cart-container" );

if ( localStorage.getItem( "user_data" ) != null )
  {
    var userId = localStorage.getItem( "user_data" ).split(",")[0]
  }

$.get( "api/api.php/cart/" + userId, function ( res )
{
  showCartItems( res )
  addEvents();
  // console.log(res)
} );



function showCartItems (arr)
{
  cartBody.html( arr.map( ( item ) =>
  {
    return `
      <tr id="row-${item.productId}">
        <th class="pl-0 border-0" scope="row">
          <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.php?id=${item.productId}"><img src="admin/images/${item.image}" alt="..." width="70"/></a>
            <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.php?id=${item.productId}">${item.name}</a></strong></div>
          </div>
        </th>
        <td class="align-middle border-0">
          <p  class="mb-0 small item-price">$${item.price}</p>
        </td>
        <td class="align-middle border-0">
          <div class="border d-flex align-items-center justify-content-between px-3">
            <span class="small text-uppercase text-gray headings-font-family">Quantity</span>
            <div class="quantity">
              <button item_id="${item.productId}" class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
              <input class="form-control form-control-sm border-0 shadow-0 p-0 item-quantity" type="text" value="${item.quantity}"/>
              <button item_id="${item.productId}" class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
            </div>
          </div>
        </td>
        <td class="align-middle border-0">
          <p class="mb-0 small total">$${item.total}</p>
        </td>
        <td class="align-middle border-0">
          <a href="" class="reset-anchor del-btn" user_id="${userId}" item_id="${item.productId}">
            <i class="fas fa-trash-alt small text-muted"></i>
          </a>
        </td>
      </tr>
    `
  } ) )
  calcTotal();
}

function addEvents ()
{
  const decreesBtn = $( ".dec-btn" );
  const increesBtn = $( ".inc-btn" );
  const deleteBtn = $( ".del-btn" );

  $.each( deleteBtn, function ( i, v )
  {
    v.onclick = function (e)
    {
      e.preventDefault();
      deleteFromDatabase( v );
    }
  } )
  
  $.each( increesBtn, function (i,v)
  {
    v.onclick = () =>
    {
      updateLocaly( v, "+" );
      updateDatabase( v, "+" );
    }
  } )
  
  $.each( decreesBtn, function (i,v)
  {
    v.onclick = () =>
    {
      updateLocaly( v, "-" );
      updateDatabase( v, "-" );
    }
  } )

}

function deleteFromDatabase (v)
{
  let pro_id = v.getAttribute( "item_id" )
  document.querySelector( `#row-${ pro_id }` ).remove()
  calcTotal();
  $.ajax({
    url: 'api/api.php/cart',
    type: 'DELETE',
    data: JSON.stringify({
      user_id: userId,
      pro_id
    }),
    contentType: 'application/json'
  } );
}

function updateDatabase (element, sign)
{
  let id = element.getAttribute( "item_id" );

  $.ajax({
    url: 'api/api.php/cart/'+sign, 
    type: 'PUT',
    data: JSON.stringify({
      user_id: userId,
      pro_id: id
    }),
    contentType: 'application/json'
  });
}

function updateLocaly (element, sign)
{
  let id = element.getAttribute( "item_id" );
  let price = +document.querySelector(`#row-${id} .item-price`).innerHTML.slice(1)
  let quantity = document.querySelector( `#row-${ id } .item-quantity` )
  sign == "+" ? ++quantity.value : --quantity.value;
  let total = price * quantity.value;
  document.querySelector( `#row-${ id } .total` ).innerHTML = "$" + total
  calcTotal()
  if ( quantity.value == 0 ) deleteFromDatabase( element );
}

function calcTotal ()
{
  let total = []
  $( ".total" ).each( function ( i, v )
  {
    total.push(+v.innerHTML.slice(1))
  } )
  if ( total.length != 0 )
  {    
    let orderTotal = total.reduce( ( a, b ) => a + b )
    $( ".orderTotal" ).html( "$"+orderTotal );
  }
}