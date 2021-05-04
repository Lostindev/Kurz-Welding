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
    
    });
    })
    