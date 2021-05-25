

  <footer class="main-footer">
    <strong>Developed by <a style="color:mediumpurple;" href="https://pivotgrowth.io">pivotgrowth.io</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
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


<!--Load Sub Category based on Main.-->

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
                    var html = '<option value="0">Select Sub Category</option>';

                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<option value="'+data[count].scId+'">'+data[count].scName+'</option>';
                    }

                    $('#subCategory').html(html);
                }
            });
        }
        else {
            $('#subCategory').val('0');
        }

    });

    $('.add_spec').click(function () {
    var sp_count = $('.sp_cn').length;
    var items = "";
    items +="<div class='form-group form_special rmov"+sp_count+"'>";
    items +="<input type='text' name='sp_val[]' class='form-control col-md-12 sp_cn' placeholder='Enter Spec Value'>";
    items +="<a href='javascript:void(0)' class='remove_spec' data-id="+sp_count+"><i class='far fa-minus-square'></i></a>";
    items +="</div>";


    var spp_count = $('.sp_p').length;
    var pitems = "";
    pitems +="<div class='form-group form_special rmop"+spp_count+"'>";
    pitems +="<input type='text' name='sp_p[]' class='form-control col-md-3 sp_p' placeholder='Enter Price Addition'>";
    pitems +="</div>";

    if (spp_count <=5) {
      $('.sp_items').append(items);
      $('.sp_items').append(pitems);
    }

    }); //End Function 

    $('body').on('click',".remove_spec",function () {
      var curnt = $(this).data('id');
      $('.rmov'+curnt).remove();
      $('.rmop'+curnt).remove()
    });

  });
})
</script>

<!-- NEW FUNTION DONT FORGET TO LABEL-->


</body>
</html>