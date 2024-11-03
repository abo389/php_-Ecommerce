// useing vinilla js
const deleteModals = document.getElementsByClassName( "do-delete" );
for ( let i = 0; i < deleteModals.length; i++ )
{
  deleteModals[ i ].addEventListener( "click", async () =>
  {
    let [ name, id ] = deleteModals[ i ].id.split( "-" );
    await fetch("delete.php", {
      method: "POST",
      headers: {
        "Content-Type":  "application/json"
      },
      body: JSON.stringify({ name, id })
    })
    document.getElementById( "item-" + id ).remove();
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
