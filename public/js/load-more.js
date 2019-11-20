let loadedMoreCount = 0;
let page_offset = 12; // use this to adjust number of load more items
let page_limit = page_offset;
let page_offset_counter = 1;

let total = 0;
let type = '';
let timer = 0;

$( document ).ready(function() {
    switch (window.location.pathname) {
        case '/search':
        case '/wines':
        case '/wines/top-rated':
        case '/hot-sellers':
            type = 'wines';

            let els = document.getElementsByClassName('vine-boxes')[0].childNodes;

            if((els.length+1)/2<page_offset) {
                hideLoadMore(true);
            }

            $.post('/totalWines', function(count) {
                total = count;
                hideLoadMore();
            });

            break;
        case '/wineries':
            type = 'wineries';
            page_offset = 8; // use this to adjust number of load more items
            age_limit = page_offset;

            $.post('/totalWineries', function(count) {
                total = count;
                hideLoadMore();
            });

            break;
    }

    console.log();

    if($('.vine-boxes').children().length < page_offset) {
        $('#loadMoreLinkA').hide();
        $('#loadMoreLink').hide();
    }

    $('#loadMoreLink').attr('href', window.location.pathname + (window.location.search==='' ? '?' : (window.location.search+'&') )
        +'page_offset=' + page_offset + '&page_limit=' + page_limit);

    $('#loadMoreLinkA').attr('href', window.location.pathname + (window.location.search==='' ? '?' : (window.location.search+'&') )
        +'page_offset=' + page_offset + '&page_limit=' + page_limit);

    $('#loadMoreArrivalsLink').attr('href', window.location.pathname + (window.location.search==='' ? '?' : (window.location.search+'&') )
        +'page_offset=' + page_offset + '&page_limit=' + page_limit);

    $(document).on("click", "#loadMoreLinkA", function (e) {
        console.log('init');
        e.preventDefault();
        let $th = $(this);

        if ($th.hasClass('processing')) return;

        $th.addClass('processing');

        console.log('requesting');

        $.get($(this).attr('href'), function (data) {
            if(data==='') $('#loadMoreLinkA').hide();
            console.log('priting');
            console.log(data);
            $('.vine-boxes').append(data);

            page_offset += page_limit;

            $('#loadMoreLinkA').attr('href', window.location.pathname + (window.location.search==='' ? '?' : (window.location.search+'&') )
                +'page_offset=' + page_offset + '&page_limit=' + page_limit);

            $th.removeClass('processing');
        });
    });

    $('#loadMoreLink').click(function (e) {
        e.preventDefault();
        let $th = $(this);

        if ($th.hasClass('processing')) return;

        $th.addClass('processing');

        $.get($(this).attr('href'), function (data) {
            console.log(data);
            if (Object.keys(data[type]).length > 0) {
                loadedMoreCount = loadedMoreCount + page_offset*2;

                let html = type === 'wines' ? moreWine(data[type]) : moreWineries(Object.values(data[type]));

                $('.vine-boxes').append(html);

                // let newPageOffset = parseInt(loadedMoreCount) + parseInt(page_offset);

                page_offset = page_offset * 2;

                $('#loadMoreLink').attr('href', window.location.pathname +
                    (window.location.search==='' ? '?' : (window.location.search+'&')) +
                    'page_offset=' + page_offset + '&page_limit=' + page_limit);

                hideLoadMore();

                if(data[type].length<4) hideLoadMore(true);
            } else {
                hideLoadMore(true);
            }
            $th.removeClass('processing');
        });
    });

    $(document).on("click", ".toggle-fav", function (e) {
        e.preventDefault();
        var that = $(this);
        let method = that.hasClass('far') ? '/favorite/' : '/unfavorite/';

        $.post(method + that.data("winename"), function (response) {
            that.toggleClass("fas far");
        });
    });

    $(document).on("click", "#loadMoreArrivalsLink", function (e) {
        e.preventDefault();

        var that = $(this);

        $.get(that.attr('href'), function (response) {
            $("#printMoreArrivals").append(response);

            page_offset_counter++;

            page_offset = page_offset * 2;
            // if(that.data("wine-count") <= page_offset*page_offset_counter*2.5){
            if(that.data("wine-count") <= page_offset){
                $("#loadMoreArrivals").fadeOut('slow');
            }
            else{
                $('#loadMoreArrivalsLink').attr('href', window.location.pathname +
                    (window.location.search==='' ? '?' : (window.location.search+'&')) +
                    'page_offset=' + page_offset + '&page_limit=' + page_limit);
            }
        });
    });
});

$(".send-wine").click(function (e) {
    e.preventDefault();

    $("#ship-wine-confirm").fadeIn();
    $("#confirm-ship-wine").attr("href", $(this).attr("href"));
});

$("#confirm-ship-wine").click(function (e) {
    e.preventDefault();

    if($("#tracking_id").val()){
        window.location.href = $(this).attr("href") + "/" + $("#tracking_id").val();
    }
    else{
        $("#tracking_id").css("border", "1px solid red");
    }
});

$("#close-popup").click(function (e) {
    e.preventDefault();

    $(".popup-holder").fadeOut();
    $("#ship-wine-confirm").fadeOut();
});

$(".delete-wine").click(function (e) {
    e.preventDefault();

    $(".default-popup").fadeIn();
    $("#wine-name-holder").text($(this).data("name"));
    $("#delete-wine-confirm").data("id", $(this).data("id"));
});

$("#delete-wine-confirm").click(function (e) {
    e.preventDefault();

    $("#delete-wine-" + $(this).data("id")).submit();
});
/*
$("#main-search").on('keyup input touchend change', function () {
    let that = $(this);

    if (timer) {
        clearTimeout(timer);
    }

    timer = setTimeout(function () {
        if(that.val().length == 0){
            $(".search-results").hide();
        }
        else{
            $.get(that.closest("form").attr("action") + "?s=" + that.val(), function(response){
                $(".search-results").empty();

                response.wines.forEach(function(element){
                    $(".search-results").append('<a class="text-red" href="/wine/' + element.slug + '">' + element.name + '</a>').show();
                });

                if(response.wines.length == 0){
                    $(".search-results").append('<p>No results found</p>');
                }
                else{
                    $(".search-results").append('<a class="text-red" href="#" id="trigger-main-search">See all results</a>');
                }

            }, "json");
        }
    }, 400);
});
*/

function liveSearch(input, output){

        input.on('keyup input touchend change', function () {
             let that = $(this);

            if (timer) {
                clearTimeout(timer);
            }

            timer = setTimeout(function () {
                if(that.val().length == 0){
                    output.hide();
                }
                else{
                    $.get(that.closest("form").attr("action") + "?s=" + that.val(), function(response){
                        output.empty();

                        response.wines.forEach(function(element){
                            output.append('<a class="text-red" href="/wine/' + element.slug + '">' + element.name + '</a>').show();
                        });

                        if(response.wines.length == 0){
                            output.append('<p>No results found</p>');
                        }
                        else{
                            output.append('<a class="text-red" href="#" id="trigger-main-search">See all results</a>');
                        }

                    }, "json");
                }
            }, 400);
    });
}

liveSearch($("#main-search-mob"),$(".search-results-mob"));
liveSearch($("#main-search"),$(".search-results"));


$(document).on("click", "#trigger-main-search", function(e){
    e.preventDefault();

    $("#main-search-form").submit();
});

function moreWine(data) {
    let retValFinal = '';
    data.forEach(function (element) {
        let retVal = '';
        retVal += '<div class="col-md-3 col-sm-6 col-xs-6 vine-box-style-3 style-3-2">';
        retVal += '<a href="' + '/wine/' + element.slug + '">';
        retVal += '<div class="image-wrap"><figure class="image-container">';
        retVal += '<img src="' + element.photo + '">';
        retVal += '<div class="overlay"></div>';
        if(typeof element.favorited !== 'undefined') {
            let favText = '<span type="wine">' + '<span>' + '<i class="';
            favText += element.favorited ? 'fas' : 'far';
            favText += ' fa-heart toggle-fav" data-winename="' + element.slug + '">' + '</i>' + '</span>' + '</span>';
            retVal += favText;
        }
        /*retVal += '<span class="sale-mark">SALE</span>';*/
        retVal += '</div>';
        retVal += '</figure><div class="product-info">';
        retVal += '<h5>';
        retVal += typeof element.name !== 'undefined' ? element.name : 'Name of wine';
        retVal += '</h5>';
        retVal += '<div class="star-rating price">';
        retVal += '<h4 class="m-0 p-0">$' + element.price.toFixed(2) + '</h4>';
        retVal += '<div data-v-34cbeed1="" class="vue-star-rating">' + '<div data-v-34cbeed1="" class="vue-star-rating">';
        for(let i=0;i<element.rating;i++) retVal += selectedStar();
        for(let i=element.rating;i<5;i++) retVal += unselectedStar();
        retVal += '</div></div></div>' + '<span class="order-q">' + element.orders_count + ' Orders</span>' + '</div></a></div>';
        retValFinal += retVal;
    });
    return retValFinal;
}

function moreWineries(data) {
    let retValFinal = '';
    data.forEach(function (element) {
        let retVal = '';
        retVal += '<div class="col-lg-6 wineries-box px-0 px-md-4"><div><a href="' + '/winery/' +  element.slug + '"><div class="wineries-brand">';
        retVal += '<img class="winery-header" src="' + (element.cover===null ? 'img/winery-1.jpg' : '/images/winery/cover/' + element.cover) + '">';
        retVal += '<img class="winery-logo" src="' + (element.profile===null ? 'img/winery-1.jpg' : '/images/winery/profile/' + element.profile) + '">';
        retVal += '</div><p>' + element.name + '</p></a>';

        if(element.wines.length>0) {
            retVal += '<div class="row latest-wines-list px-3 mt-4">';

            element.wines.slice(-3).forEach(function (wine) {
                retVal += '<div class="top-wine col-4 vine-box-style-3 px-2">';
                retVal += '<a href="/wine/' + wine.slug + '"><div class="image-container">';
                retVal += '<img src="' + wine.photo + '">';
                retVal += '<span class="pricing price">$' + wine.price.toFixed(2) + '</span>';
                retVal += '</div></a></div>';
            });

            retVal += '</div>';
        }

        retVal += '</div></div>';
        retValFinal += retVal;
    });
    return retValFinal;
}

function selectedStar() {
    return '<span data-v-34cbeed1="" class="vue-star-rating-star" style="margin-right: 0px;"><svg data-v-21f5376e="" data-v-34cbeed1="" height="15" width="15" viewBox="0 0 15 15" class="vue-star-rating-star" step="100"><linearGradient data-v-21f5376e="" id="qck14n" x1="0" x2="100%" y1="0" y2="0"><stop data-v-21f5376e="" offset="100%" stop-color="#991D3F"></stop> <stop data-v-21f5376e="" offset="100%" stop-color="#d8d8d8"></stop></linearGradient> <filter data-v-21f5376e="" id="3enjj" height="130%" width="130%" filterUnits="userSpaceOnUse"><feGaussianBlur data-v-21f5376e="" stdDeviation="0" result="coloredBlur"></feGaussianBlur> <feMerge data-v-21f5376e=""><feMergeNode data-v-21f5376e="" in="coloredBlur"></feMergeNode> <feMergeNode data-v-21f5376e="" in="SourceGraphic"></feMergeNode></feMerge></filter> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#qck14n)" stroke="#fff" filter="url(#3enjj)"></polygon> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#qck14n)" stroke="#999" stroke-width="0" stroke-linejoin="miter"></polygon> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#qck14n)"></polygon></svg></span>';
}

function unselectedStar() {
    return '<span data-v-34cbeed1="" class="vue-star-rating-star" style="margin-right: 0px;"><svg data-v-21f5376e="" data-v-34cbeed1="" height="15" width="15" viewBox="0 0 15 15" class="vue-star-rating-star" step="100"><linearGradient data-v-21f5376e="" id="krj8ly" x1="0" x2="100%" y1="0" y2="0"><stop data-v-21f5376e="" offset="0%" stop-color="#991D3F"></stop> <stop data-v-21f5376e="" offset="0%" stop-color="#d8d8d8"></stop></linearGradient> <filter data-v-21f5376e="" id="nxiilm" height="130%" width="130%" filterUnits="userSpaceOnUse"><feGaussianBlur data-v-21f5376e="" stdDeviation="0" result="coloredBlur"></feGaussianBlur> <feMerge data-v-21f5376e=""><feMergeNode data-v-21f5376e="" in="coloredBlur"></feMergeNode> <feMergeNode data-v-21f5376e="" in="SourceGraphic"></feMergeNode></feMerge></filter> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#krj8ly)" stroke="#fff" filter="url(#nxiilm)" style="display: none;"></polygon> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#krj8ly)" stroke="#999" stroke-width="0" stroke-linejoin="miter"></polygon> <polygon data-v-21f5376e="" points="6.818181818181818,0.7575757575757576,2.2727272727272725,15,13.636363636363637,5.909090909090909,0,5.909090909090909,11.363636363636363,15" fill="url(#krj8ly)"></polygon></svg></span>';
}

function hideLoadMore(force=false) {
    if(page_offset >= total||force){
        $("#loadMore").fadeOut('slow');
    }
}
