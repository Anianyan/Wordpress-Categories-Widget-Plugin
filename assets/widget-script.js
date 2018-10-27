(function($) {
    $(document).ready(function() {
        //
        $('.category-list li').on('click',function() {
            $('#list-categories-widget .category-list').hide();
            let catId = $(this).data('id');

            $.post( ajax_url.url, {
                action: 'get_cat_posts',
                id: catId,
            }, function(data) {
                if ( data.success ) {

                    let postsHTML = `<div class="row bordered posts-list">
                                        <ul>`;
                    for (let id in data.data) {
                        postsHTML += `<li>${data.data[id]}</li>`
                    }
                    postsHTML += `</ul>
                                   </div>
                                   <div class="button">
                                        <button class="back-button bordered w-100">Back</button>
                                    </div>`;
                    $('#list-categories-widget').append(postsHTML);
                    $('#list-categories-widget .button').on('click', function() {
                        $('#list-categories-widget .posts-list').remove();
                        $('#list-categories-widget .button').remove();
                        $('#list-categories-widget .category-list').show();
                    })
                } else {
                    alert('Try again');
                }

            });
        });
    });
})(jQuery);
