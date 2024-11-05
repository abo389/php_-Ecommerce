const form = document.getElementById( "sortForm" );
const select = document.getElementById( "sortSelect" );

select.addEventListener( "change", () =>
{
  form.submit();
})