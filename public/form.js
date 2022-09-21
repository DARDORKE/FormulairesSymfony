jQuery(document).ready(function() {
    let $ingredientsCollectionHolder = $('ul.ingredients');
    $ingredientsCollectionHolder.data('index', $ingredientsCollectionHolder.find('input').length);
    $('body').on('click', '.add_item_link', function(e) {
        let $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        addFormToCollection($collectionHolderClass);
    })
});

function addFormToCollection($collectionHolderClass) {
    let $collectionHolder = $('.' + $collectionHolderClass);
    let prototype = $collectionHolder.data('prototype');
    let index = $collectionHolder.data('index');

    let newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);

    let $newFormLi = $('<li></li>').append(newForm);
    $collectionHolder.append($newFormLi)
}