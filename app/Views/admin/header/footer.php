

  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/adminlte/plugins/moment/moment.min.js"></script>
<script src="/assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/adminlte/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="/assets/adminlte/dist/js/pages/dashboard.js"></script> -->


<!--Custom Admin JS-->

<script type="text/javascript">
$(function () {
$(document).ready(function() {
    $('#categoryId').change(function(){
        var category_id = $('#categoryId').val();
        var action = 'get_sub_cat';

        if(category_id != '0')
        {
            $.ajax({
                url:"<?php echo site_url('/admin/action');?>",
                method:"POST",
                data:{category_id:category_id, action:action},
                dataType:"JSON",
                success:function(data)
                {
                  console.log(data);
                    var html = '<option value="">Select Sub Category</option>';

                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<option value="'+data[count].category_id+'">'+data[count].scName+'</option>';
                    }

                    $('#subCategory').html(html);
                }

            });
        }
        else {
            $('#subCategory').val('0');
        }

    });

});
})


</script>

<script src="/js/admincustom.js"></script>
<script type="text/javascript">
  var surl = "<?php echo site_url()?>";
  var burl = "<?php echo base_url() ?>";
</script>
</body>
</html>