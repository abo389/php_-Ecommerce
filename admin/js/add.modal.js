const addForm = document.getElementById( "add-form" );
const closeBtn = document.getElementById( "close-add" );
const tableBody = document.getElementById( "tableBody" );
const modalsWrapper = document.getElementById( "modals-wrapper" );


addForm.addEventListener( "submit", async ( event ) =>
{
  event.preventDefault();
  let data = {};
  for (let i = 0; i < addForm.children.length - 1; i++) {
    let key = addForm.children[ i ].children[ 1 ].name
    let value = addForm.children[ i ].children[ 1 ].value
    data[ key ] = value;
  }

  const response = await fetch("includes/functions/do_add.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(data)
  });
  
  const res = await response.json();
  // Handle the response here
  // console.log( res );
  if ( res.status === "success" )
  {
    let id = res.id;
    let table_name = Object.values( data )[ 0 ];
    let row = tableRow( data, table_name, id );

    tableBody.innerHTML += row;
    closeBtn.click();
    // addForm.setAttribute("aria-hidden","true")
    // addBtn.setAttribute("data-dismiss","modal")
  }

} )

function tableRow ( obj, t_name, id )
{
  let row = "<td>"+id+"</td>";
  for ( let i = 1; i < Object.keys( obj ).length; i++ )
  {
    let v = Object.values( obj )[ i ]
    if ( Object.keys( obj )[ i ] === "permission" )
    {
      row += "<td>" + permission( v ) + "</td>";
      continue
    }
    if ( Object.keys( obj )[ i ] === "gender" )
    {
      row += "<td>" + gender( v ) + "</td>";
      continue
    }
    row += "<td>"+v+"</td>"
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

  const deleteModals = document.getElementsByClassName( "do-delete" );
  for ( let i = 0; i < deleteModals.length; i++ )
  {
    deleteModals[ i ].addEventListener( "click", async () =>
    {
      let [ name, id ] = deleteModals[ i ].id.split( "-" );
      let response = await fetch("delete.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({ name, id })
      })
      document.getElementById( "item-" + id ).remove()
      let res = await response.text();
      console.log(res)
    })
  }
  // let allDeleteBtns = document.getElementsByClassName( "do-delete" );
  // let lastIndex = ( ( allDeleteBtns ).length - 1 )
  // let deleteBtn = allDeleteBtns[ lastIndex ];
  // deleteBtn.addEventListener( "click", async () =>
  //   {
  //     let [ name, id ] = deleteBtn.id.split( "-" );
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
}

function permission (num)
{
  permission = [ "owner", "admin", "operator", "user" ];
  return permission[num-1]
}

function gender (num)
{
  permission = [ "", "", "Male", "Female" ];
  return permission[num-1]
}