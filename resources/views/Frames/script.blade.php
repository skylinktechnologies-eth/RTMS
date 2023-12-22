<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- Plugin js for this page -->
<script src="../../assets/vendors/chart.js/Chart.min.js"></script>
<script src="../../assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>
<script src="../../assets/js/misc.js"></script>
<!-- endinject -->
{{-- <script src="../../assets/js/datatables.min.js"></script>
      <script src="../../assets/js/pdfmake.min.js"></script>
      <script src="../../assets/js/vfs_font.js"></script> --}}

<!-- Custom js for this page -->
<script src="../../assets/js/dashboard.js"></script>
<script src="../../assets/js/todolist.js"></script>




<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#mySelect').select2({
            placeholder: 'Select an option',
            allowClear: true, // Enables the clear button
        });


    });
</script>
<script>
    new DataTable('#example');

    //   $(document).ready(function() {
    //       $('#example').DataTable({
    //           dom: 'Bfrtip',
    //           buttons: [
    //               'copy', 'csv', 'excel', 'pdf', 'print'
    //           ]
    //       });
    //   });
</script>


<script>
    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 3000);
</script>

<!-- Your additional scripts go here -->
