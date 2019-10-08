window.Dropzone = require('./vendor/dropzone');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $("#picture").change(function() {
        readURL(this, $('#imagePreview'));

        $(".add-new-wine button#submit").prop("disabled", "disabled");
        $("#crop-error").show();
    });

    $("#other_image").change(function(event){
        readURL(this, $('#otherImagePreview'));

        $(".add-new-wine button#submit").prop("disabled", "disabled");
        $("#crop-error").show();
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

    $("#crop-other-picture").click(function(e){
        e.preventDefault();

        var cropdata = $('#otherImagePreview').data("cropper").getData(true);
        var crop_image_preview = $('#otherImagePreview').cropper('getCroppedCanvas').toDataURL();

        $(this).hide();
        $("#other_image").prop("disabled", false);
        $(".add-new-wine button#submit").prop("disabled", false);
        $('#otherImagePreview').cropper('destroy').attr('src', '/img/primary-photo.jpg');
        $("#crop-error").hide();

        var formData = new FormData();
        formData.append('image', $("#other_image")[0].files[0]);
        formData.append('cropx', cropdata.x);
        formData.append('cropy', cropdata.y);
        formData.append('cropwidth', cropdata.width);
        formData.append('cropheight', cropdata.height);

        $.ajax({
            url : "/wine-image",
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,
            success : function(response) {
                $(`<input type="hidden" name="images[]" value="${response.id}" />`).appendTo("#inputs");
                $(".other_images_preview").append('<img src="' + crop_image_preview + '">');
            }
        });
    });
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
                aspectRatio: 0.7,
                rotatable: false,
                scalable: false,
                zoomable: false
            });

            if(selector.is("#otherImagePreview")){
                $("#crop-other-picture").show();
            }
            else{
                $("#crop-picture").show();
            }
        },1000);

        $("#picture").prop("disabled", "disabled");
        $("#other_image").prop("disabled", "disabled");
    }
}