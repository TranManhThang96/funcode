$(document).ready(function () {
    $('#save-category').on('click', function () {
        console.log($('#form-category').serialize())
        $.ajax({
            url: 'test.php',
            type: "post",
            data: $('#form-category').serialize(),
            success: function (response) {
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, errorThrown);
            }
        });
    })
})
