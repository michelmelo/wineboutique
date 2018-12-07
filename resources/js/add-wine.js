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
    $("#picture").change(function() {
        readURL(this, '#imagePreview');
    });
});

Dropzone.options.photos = {
    url: "/wine-image",
    paramName: "image",
    maxFilesize: 10,
    resizeWidth: 1200,
    resizeMimeType: "image/jpeg",
    acceptedFiles: "image/jpeg,image/jpg,image/png,image/gif,image/webp",
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        }
        else { done(); }
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
        if(preloadedImages) {
            const thisDropzone = this;

            preloadedImages.forEach(preloadedImage => {
                const mockFile = { 
                    name: preloadedImage.path.replace(/^.*[\\\/]/, ''), 
                    size: preloadedImage.size,
                    status: Dropzone.ADDED,
                    accepted: true
                }; 

                thisDropzone.emit("addedfile", mockFile);
                thisDropzone.emit("photo", mockFile, preloadedImage.path);
                thisDropzone.emit("complete", mockFile);
                thisDropzone.files.push(mockFile);
                $(`img[src='${preloadedImage.path}']`)
                    .closest(".dz-preview")
                    .attr("data-id", preloadedImage.id);
            });

            console.log(preloadedImages);
        }
    }
};