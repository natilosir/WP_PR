jQuery(document).ready(function ($) {
    var searchTimer;
    var searchInput      = $('#live-search-input');
    var resultsContainer = $('.search-results-container');

    // تابع انجام جستجو
    function performLiveSearch (searchTerm) {
        if ( searchTerm.length < 2 ) {
            resultsContainer.hide().empty();
            return;
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'live_search',
                search_term: searchTerm,
                security: ajax_object.ajax_nonce
            },
            beforeSend: function () {
                resultsContainer.html('<div class="search-loading">Loading...</div>').show();
            },
            success: function (response) {
                if ( response.success ) {
                    resultsContainer.html(response.data);
                    resultsContainer.show();
                } else {
                    resultsContainer.html('<div class="no-results">No results found</div>').show();
                }
            },
            error: function () {
                resultsContainer.html('<div class="search-error">Error occurred</div>').show();
            }
        });
    }

    // رویداد تایپ
    searchInput.on('input', function () {
        clearTimeout(searchTimer);
        var searchTerm = $(this).val().trim();

        if ( searchTerm.length >= 2 ) {
            searchTimer = setTimeout(function () {
                performLiveSearch(searchTerm);
            }, 1000); // تاخیر 1 ثانیه قبل از جستجو
        } else {
            resultsContainer.hide().empty();
        }
    });

    // بستن نتایج هنگام کلیک خارج
    $(document).on('click', function (e) {
        if ( !$(e.target).closest('.live-search-container').length ) {
            resultsContainer.hide();
        }
    });

    // پیشگیری از ارسال فرم
    $('.search-form').on('submit', function (e) {
        e.preventDefault();
    });
});