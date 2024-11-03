const addForm = document.getElementById( "add-form" );
const addBtn = document.getElementById( "do-add" );
console.log( "hellllo" )
addForm.addEventListener( "submit", async (event) =>
{
  event.preventDefault();
  let data = {};
  for (let i = 0; i < addForm.children.length - 1; i++) {
    let key = addForm.children[ i ].children[ 1 ].name
    let value = addForm.children[ i ].children[ 1 ].value
    data[ key ] = value;
  }
  // console.log( data )

  const response = await fetch("includes/functions/do_add.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams(data)
  });
  
  const res = await response.text();
  // Handle the response here
  console.log(res);

})
