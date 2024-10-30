
let Modals = $( ".modal .do-delete" );

for (let i = 0; i < Modals.length; i++) {
  Modals[ i ].onclick = () =>
  {
    let d = Modals[ i ].id.split( "-" )
    
    $.post( "delete.php", {
      name: d[0],
      id: d[1]
    },(res)=>{console.log(res)})

    // console.log(Modals[i] )
    // console.log(Modals[i].id.split( "-" ) )
  } 
}
