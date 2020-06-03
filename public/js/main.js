var url = location.protocol + "//" + location.host;

window.addEventListener("load", function () {

    like();

    function like() {
        $('.fa-heart').unbind().click(function () {

            if ($(this).hasClass('text-danger')) {
                $(this).removeClass('text-danger');
                var url_sel = 'dislike';
            } else {
                $(this).addClass('text-danger');
                var url_sel = 'like';
            }

            $.ajax({
                url: url+'/'+url_sel+'/'+$(this).data('id'),
                type: 'GET',
                success: function (response) {
                }
            });
        });
    }

});
