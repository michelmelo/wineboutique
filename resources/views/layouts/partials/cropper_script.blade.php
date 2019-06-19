<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.js"></script>
<script>
    const image = document.getElementById('croppable-image');
    let retVal = { x: 0, y: 0, w: 0, h: 0 };
    var cropper;
    var current;

    function newCropper(cur) {
        current = cur;
        $('#cropper').show();
        // image.setAttribute('src', img);
        if(typeof cropper !== 'undefined') cropper.destroy();
        cropper = new Cropper(image, {
            aspectRatio: 9 / 16,
            autoCropArea: 0.98,
            strict: true,
            crop(event) {
                retVal.x = event.detail.x;
                retVal.y = event.detail.y;
                retVal.h = event.detail.height;
                retVal.w = event.detail.width;
                let l = cropper.getCanvasData();
                // console.log(l);
            },
            zoom: function (event) {
                event.preventDefault();
            }
        });
    }

    function repaint() {
        cropper.replace(document.getElementById('imagePreview').getAttribute('src'));
    }

    document.getElementById('success').onclick = function () {
        // let addr = '/cropImg';
        // let current = image.getAttribute('src');
        // current = current.split('?')[0]; //in case we attached a timestamp before

        document.getElementById(current).value = JSON.stringify(retVal);
        $('#imagePreview').css({
            'position' : 'absolute',
            'overflow' : 'hidden',
            // 'background-position' : retVal.w + 'px ' + retVal.h + 'px',
            // 'background-position-y' : retVal.y + 'px',
            'clip' : 'rect('+ retVal.x + ', ' + retVal.y + ', ' + retVal.w + ', ' + retVal.h + ')',
        });
        console.log('rect('+ retVal.x + ', ' + retVal.y + ', ' + retVal.w + ', ' + retVal.h + ')');

        $('.wrapper').css({
            // 'width' : retVal.x + 'px',
            // 'height:' : retVal.y + 'px',
        });


        /*
        $.get(addr, { 'dimensions': retVal, 'imgPath': current })
        .done(function () {
            cropper.replace(current+ '?' + (new Date()).getTime());
            }
        );*/
        $('#cropper').hide();
        cropper.destroy();
    };

    // document.getElementById('close-cropper').onclick = function () {
    //     $('#cropper').hide();
    //     cropper.destroy();
    // }
</script>