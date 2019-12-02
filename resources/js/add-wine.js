window.Dropzone = require('./vendor/dropzone');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $("#picture").change(function(e) {
        let target = e.target || e.srcElement;
        if(target.value.length>0) {
            readURL(this, $('#imagePreview'));

            $(".add-new-wine button#submit").prop("disabled", "disabled");
            $("#crop-error").show();
        }
    });

    $("remove-icon").click(function(){
        $(this).parent().remmove();
    });

    $("#other_image").change(function(e){
        let target = e.target || e.srcElement;
        if(target.value.length>0) {
            readURL(this, $('#otherImagePreview'));

            $(".add-new-wine button#submit").prop("disabled", "disabled");
            $("#crop-error").show();
        }
    });

    $("#crop-picture").click(function (e) {
        e.preventDefault();

        var cropdata = $('#imagePreview').data("cropper").getData(true);

        $(this).hide();

        var crop_image_preview = $('#imagePreview').cropper('getCroppedCanvas').toDataURL();

        $('#imagePreview').cropper('destroy').attr('src', crop_image_preview);
        $(".add-new-wine button#submit").prop("disabled", false);
        $("#crop-error").hide();
        $("#other_image").prop("disabled", false);
        $("#picture").prop("disabled", false);
        $("#cancel-crop-picture").hide();

        $("#cropx").val(cropdata.x);
        $("#cropy").val(cropdata.y);
        $("#cropwidth").val(cropdata.width);
        $("#cropheight").val(cropdata.height);
    });

    $("#cancel-crop-picture").click(function (e) {
        e.preventDefault();

        $('#imagePreview').cropper('destroy').attr('src', $('#imagePreview').data("default"));
        $(".add-new-wine button#submit").prop("disabled", false);
        $("#crop-error").hide();
        $("#other_image").prop("disabled", false);
        $("#picture").prop("disabled", false).val("");
        $("#crop-picture").hide();
        $(this).hide();
    });

    $("#cancel-crop-other-picture").click(function(e){
        e.preventDefault();

        $("#other_image").prop("disabled", false).val("");
        $("#picture").prop("disabled", false);
        $(".add-new-wine button#submit").prop("disabled", false);
        $('#otherImagePreview').cropper('destroy').attr('src', $('#otherImagePreview').data("default"));
        $("#crop-error").hide();
        $("#crop-other-picture").hide();
        $(this).hide();
    });

    $("#crop-other-picture").click(function(e){
        e.preventDefault();

        var cropdata = $('#otherImagePreview').data("cropper").getData(true);
        var crop_image_preview = $('#otherImagePreview').cropper('getCroppedCanvas').toDataURL();

        $(this).hide();
        $("#other_image").prop("disabled", false);
        $("#picture").prop("disabled", false);
        $(".add-new-wine button#submit").prop("disabled", false);
        $('#otherImagePreview').cropper('destroy').attr('src', '/img/every-angle.jpg');
        $("#crop-error").hide();
        $("#cancel-crop-other-picture").hide();

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
                $(".other_images_preview").append('<div class="image-delete-holder"><img src="' + crop_image_preview + '"><a class="remove-icon"><i class="fas fa-trash-alt"></i></a></div>');
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
                $("#cancel-crop-other-picture").show();
            }
            else{
                $("#crop-picture").show();
                $("#cancel-crop-picture").show();
            }
        },1000);

        $("#picture").prop("disabled", "disabled");
        $("#other_image").prop("disabled", "disabled");
    }
}
