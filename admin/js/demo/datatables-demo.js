// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    ajax: "includes/functions/serverSideProccess.php",
    processing: true,
    serverSide: true
});
});


// $.get("includes/functions/serverSideProccess.php", function (res) {
//   console.log(typeof res)
//   console.log(JSON.parse(res))
// })