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
            $(selector).attr('src', e.target.result);
            $(selector).hide();
            $(selector).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    cropper.start(document.getElementById("cropCanvas"), 1);

    $("#picture").change(function() {
        // readURL(this, '#imagePreview');

        // this function will be called when the file input below is changed
        var file = document.getElementById("picture").files[0];  // get a reference to the selected file

        var reader = new FileReader();

        // set an onload function to show the image in cropper once it has been loaded
        reader.onload = function(event) {
            var data = event.target.result; // the "data url" of the image
            cropper.showImage(data); // hand this to cropper, it will be displayed
            cropper.startCropping();
        };

        // this loads the file as a data url calling the function above once done
        reader.readAsDataURL(file);
        $(".crop-holder").show();
    });

    $("#crop-it").click(function () {
        $("#imagePreview").attr('src', cropper.getCroppedImageSrc());
        $(".crop-holder").hide();
    });

    $(".add-more-images").click(function(e){
        e.preventDefault();

        $("#photos").click();
    });
});

Dropzone.options.photos = {
    url: "/wine-image",
    paramName: "image",
    maxFilesize: 10,
    resizeMimeType: "image/jpeg",
    acceptedFiles: "image/jpeg,image/jpg,image/png,image/gif,image/webp",
    addRemoveLinks: true,
    dictDefaultMessage: "Click here to add more images!",
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        }
        else { document.getElementsByClassName('add-more-images')[0].style.visibility = "visible"; done(); }
    },
    sending: function(file, xhr, formData) {
        formData.append("_token", document.querySelector("input[name='_token']").value);
    },
    success: function(file, response) {
        $(file.previewElement).attr("data-id", response.id);
        $(`<input type="hidden" name="images[]" value="${response.id}" />`).appendTo("#inputs");
    },
    removedfile: async function(file) {
        const $filePreview = $(file.previewElement);
        const id = $filePreview.data("id");
        $filePreview.remove();
        $(`[name="images[]"][value="${id}"]`).remove();
        if($('[name="_method"][value="PUT"]').length) {
            $(`<input type="hidden" name="delete_images[]" value="${id}" />`).appendTo("#inputs");
        } else {
            $.ajax({
                url: `/wine-image/${id}`,
                type: 'DELETE'
            });
        }
    },
    init: function() {
        if(typeof preloadedImages !== "undefined") {
            const thisDropzone = this;

            preloadedImages.forEach(preloadedImage => {
                document.getElementsByClassName('add-more-images')[0].style.visibility = "visible";
                const mockFile = { 
                    name: preloadedImage.path.replace(/^.*[\\\/]/, ''), 
                    size: preloadedImage.size,
                    status: Dropzone.ADDED,
                    accepted: true
                }; 

                thisDropzone.emit("addedfile", mockFile);
                thisDropzone.emit("thumbnail", mockFile, preloadedImage.path);
                thisDropzone.emit("complete", mockFile);
                thisDropzone.files.push(mockFile);
                $(`img[src='${preloadedImage.path}']`)
                    .closest(".dz-preview")
                    .attr("data-id", preloadedImage.id);
            });
        }
    }
};