

$(function () {
    $(document).ready(function () {
        $('.deleteCat').click(function () {
            var id = $(this).data('id');
            var text = $(this).data('id');
            $.ajax({
                type : 'POST',
                url : surl+'admin/deleteCategory',
                data : {
                    id:id,
                    text:text
                },
                success:function (data) {
                    console.log(data);
                },
                error:function () {

                }
            });
        });
    });
})