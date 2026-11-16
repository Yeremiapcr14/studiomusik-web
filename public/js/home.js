studioCards.forEach(function (card) {

    const isMatch =
        selectedStudio === 'semua' ||
        card.dataset.studio === selectedStudio;

    card.style.display = isMatch ? '' : 'none';

});
