// useing vinilla js
const deleteModals = document.getElementsByClassName( "do-delete" );
for ( let i = 0; i < deleteModals.length; i++ )
{
  deleteModals[ i ].addEventListener( "click", async (e) =>
  {
    let [ name, id ] = e.target.id.split( "-" );
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

// useing jquery
// let Modals = $( ".modal .do-delete" );

// for ( let i = 0; i < Modals.length; i++ )
// {
//   Modals[ i ].onclick = () =>
//   {
//     let [name,id] = Modals[ i ].id.split( "-" );
//     $( "#item-" + id ).remove();
    
    // $.post( "delete.php", {
    //   name,
    //   id
    // }, ( res ) =>{ }
    // )
//   } 
// }
