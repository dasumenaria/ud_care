 </div>

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
 
      </div>
      <strong>
Maintain and Developed by PHP Poets IT Solutions Pvt. Ltd. 

    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../assest/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assest/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assest/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src=" ../assest/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src=" ../assest/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src=" ../assest/dist/js/demo.js"></script>
<script src="../assest/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assest/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../assest/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../assest/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
$('.datepicker').datepicker({
	  autoclose: true
});
$(".timepicker").timepicker({
  showInputs: false
});
</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
