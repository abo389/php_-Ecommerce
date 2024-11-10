const addForm = document.getElementById( "add-form" );
const closeBtn = document.getElementById( "close-add" );
const tableBody = document.getElementById( "tableBody" );
const modalsWrapper = document.getElementById( "modals-wrapper" );

addForm.addEventListener( "submit", ( event ) =>
{
  event.preventDefault();
  const formData = new FormData( addForm );

  $.ajax({
    url: "includes/functions/do_add.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      if ( response.status === "error" )
      {
        showErrors(response.message);
      }
      if ( response.status === "success" )
        {
          let id = response.id;
          let table_name = formData.get("table_name");
          let imgs = response.images;
          let obj = Object.fromEntries( formData );
          let row = tableRow( obj, table_name, id, imgs );
          tableBody.innerHTML += row;
          closeBtn.click();
      }
    }
} );

} )

const idToName = {
  "cat": [ "tv", "mobile", "t-shirt", "watch", "laptop", "pc", "head-phone" ],
  "brand": ["apple", "Samsung", "dell", "LG", "zara", "ASUS", "honor", "NIKE"],
  "permission": [ "owner", "admin", "operator", "user" ],
  "gender": [ "", "", "male", "female" ]
}

function showErrors (errors)
{
  let len = addForm.children.length;
  for ( let k = 0; k < len; k++ )
  {
    let input = addForm.children[ k ];
    let inputName = addForm.children[ k ].children[ 1 ].name;
    if ( inputName === "table_name" ) continue;
    if ( errors[inputName] )
    {
      let errorDiv = document.createElement( "div" );
      errorDiv.classList.add("alert")
      errorDiv.classList.add( "alert-danger" )
      errorDiv.innerHTML = errors[inputName]
      input.appendChild(errorDiv)
    }
  }
}

function tableRow ( obj, t_name, id, imgs )
{
  if ( t_name === "products" )
  {
    obj[ "images[]" ] = imgs;
  }
  let row = "<td>"+id+"</td>";
  for ( let i = 1; i < Object.keys( obj ).length; i++ )
  {
    let v = Object.values( obj )[ i ];
    let k = Object.keys( obj )[ i ];

    switch (k) {
      case "permission":
      case "gender":
      case "brand":
      case "cat":
        row += "<td>" + idToName[k][v-1] + "</td>";
        break;
    
      case "images[]":
        row += "<td>0</td>"
        row += "<td>"
        for (let j = 0; j < v.length; j++) {
          row += `<img style='width: 50px;' src='images/${v[j]}' />`
        }
        row += "</td>"
        break;
      
      default:
        row += "<td>"+v+"</td>"
        break;
    }

  }

  row += `
  <td>
    <a style="display: inline-block;"
    href="?name=${t_name}&action=edit&id=${id}">
      <button class="btn btn-secondary">Edit</button>
    </a>
    <button type="button" 
    class="btn btn-danger ml-1" data-toggle="modal" 
    data-target="#${t_name}-${id}">
      Delete
    </button>
  </td>
  `
  createDeleteModal( t_name, id );

  return `<tr id="item-${id}"> ${row} </tr>`;
}

function createDeleteModal ( t_name, id )
{

  modalsWrapper.innerHTML += `
  <div class="modal fade" id="${t_name}-${id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Are You sure</h1>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          this action can be reversed
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-dismiss="modal" id="${t_name}-${id}" class="btn btn-danger do-delete">Delete</button>
        </div>
      </div>
    </div>
  </div>
  `

  // const deleteModals = document.getElementsByClassName( "do-delete" );
  // for ( let i = 0; i < deleteModals.length; i++ )
  // {
  //   deleteModals[ i ].addEventListener( "click", async () =>
  //   {
  //     let [ name, id ] = deleteModals[ i ].id.split( "-" );
  //     let response = await fetch("delete.php", {
  //       method: "POST",
  //       headers: {
  //         "Content-Type": "application/x-www-form-urlencoded"
  //       },
  //       body: new URLSearchParams({ name, id })
  //     })
  //     document.getElementById( "item-" + id ).remove()
  //     let res = await response.text();
  //     console.log(res)
  //   })
  // }
}
