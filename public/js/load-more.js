$( document ).ready(function() {
    var loadedMoreCount = 0;
    var page_offset = 4;

    $('#loadMoreLink').attr('href', window.location.pathname + '?page_offset=' + page_offset);

    $('#loadMoreLink').click(function (e) {
        e.preventDefault();
        var $th = $(this);
        if ($th.hasClass('processing'))
            return;
        $th.addClass('processing');
        $.get($(this).attr('href'), function (data) {
            if (data['wines'].length > 0) {
                loadedMoreCount = loadedMoreCount + 4;
                $('.vine-boxes').append(moreWine(data['wines']));
                var newPageOffset = parseInt(loadedMoreCount) + parseInt(page_offset);
                $('#loadMoreLink').attr('href', window.location.pathname + '?page_offset=' + newPageOffset);
            } else {
                $("#loadMore").fadeOut('slow');
            }

            if(!data['loadMore']) {
                $("#loadMore").fadeOut('slow');
            }

            $th.removeClass('processing');
        });
    });

    function moreWine(data) {
        let retVal = '';
        data.forEach(function (element) {
            retVal += '<div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">';
            retVal += '<a href="' + '/wine/' + element.slug + '">';
            retVal += '<div class="image-container">';
            retVal += '<img src="' + element.photo + '" >';
            if(typeof element.favorited !== 'undefined') {
                retVal += '<favorite';
                retVal += ':post="' + element.slug +'"';
                retVal += ':type="\'wine\'"';
                retVal += '></favorite>';
            }
            retVal += '<span class="sale-mark">SALE</span></div>';
            retVal += '<div class="product-info">';
            retVal += '<h5>' + typeof element.name !== 'undefined' ? element.name : 'Name of wine' + '</h5>';
            retVal += '<h4>' + element.price + '</h4>';
            retVal += '<div class="star-rating">';
            retVal += '<star-rating :star-size="15" active-color="#991D3F" :show-rating="false" :read-only="true" :rating="' + element.rating + '"></star-rating>';
            retVal += '</div><span class="order-q">' + element.orders_count + ' Orders</span></div></a></div>';
        });
        return retVal;
    }

});