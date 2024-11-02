let Modals = $( ".modal .do-delete" );

for ( let i = 0; i < Modals.length; i++ )
{
  Modals[ i ].onclick = () =>
  {
    [name,id] = Modals[ i ].id.split( "-" );
    $( "#item-" + d[1] ).remove();
    
    $.post( "delete.php", {
      name,
      id
    }, ( res ) =>
    { console.log( "#item-" + res ); }
    )
  } 
}
