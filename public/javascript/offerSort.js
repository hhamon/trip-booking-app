/**
 *
 * @param {string} property
 * @returns {number}
 */
function getSortingProperty(property)
{
    const properties = {
        PRICE: "price",
        RATING: "rating"
    }
    switch(property) {
        case properties.PRICE:
            return 0;
        case properties.RATING:
            return 1;
        default:
            return 0;
    }
}

/**
 *
 * @param {string} property
 */
function sortOffersByProperty(property)
{
    let wrapper = $('#offers-wrapper');
    switch(getSortingProperty(property)) {
        case 0:
            wrapper.find('.offer-table-row').sort(function (a,b) {
                return +a.dataset.price - +b.dataset.price;
            }).appendTo(wrapper);
            break;
        case 1:
            wrapper.find('.offer-table-row').sort(function (a,b) {
                return -(+a.dataset.rating - +b.dataset.rating);
            }).appendTo(wrapper);
            break;
        default:
            wrapper.find('.offer-table-row').sort(function (a,b) {
                return +a.dataset.price - +b.dataset.price;
            }).appendTo(wrapper);
    }
}