 $('#datepick input').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked"
    });
      $(function () {
        $('#category').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
          
        });
      });
      
      
      
     
/*function findAddress() {

var input = document.getElementById('address1');
var autocomplete = new google.maps.places.Autocomplete(input);
}
*/
