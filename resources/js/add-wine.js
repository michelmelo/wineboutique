window.Dropzone = require('./vendor/dropzone');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            selector.attr('src', e.target.result);
            selector.hide();
            selector.fadeIn(650);
        };

        reader.readAsDataURL(input.files[0]);

        setTimeout(function () {
            selector.cropper({
                aspectRatio: 0.9,
                rotatable: false,
                scalable: false,
                zoomable: false
            });

            $("#crop-picture").show();
        },1000);

        $("#picture").prop("disabled", "disabled");
    }
}

$(document).ready(function() {
    $("#picture").change(function() {
        readURL(this, $('#imagePreview'));
    });

    $("#crop-picture").click(function (e) {
        e.preventDefault();

        var cropdata = $('#imagePreview').data("cropper").getData(true);

        $(this).hide();
        $("#picture").prop("disabled", false);

        var crop_image_preview = $('#imagePreview').cropper('getCroppedCanvas').toDataURL();

        $('#imagePreview').cropper('destroy').attr('src', crop_image_preview);
        $(".add-new-wine button#submit").prop("disabled", false);
        $("#crop-error").hide();

        $("#cropx").val(cropdata.x);
        $("#cropy").val(cropdata.y);
        $("#cropwidth").val(cropdata.width);
        $("#cropheight").val(cropdata.height);
    });

    $(".add-more-images").click(function(e){
        e.preventDefault();

        $("#photos").click();
    });

    $("#picture").change(function(){
        $(".add-new-wine button#submit").prop("disabled", "disabled");
        $("#crop-error").show();
    });

    $(".other_image").change(function(event){
        var formData = new FormData();
        formData.append('image', $(this)[0].files[0]);

        $.ajax({
            url : "/wine-image",
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,
            success : function(response) {
                $(`<input type="hidden" name="images[]" value="${response.id}" />`).appendTo("#inputs");
                $(".other_images_preview").append('<img src="' + URL.createObjectURL(event.target.files[0]) + '">');
            }
        });
    });
});