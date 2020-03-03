$('.popup-link').each(function () {
    const targetSelector = $(this).attr('href');
    // const target = $(targetSelector);
    const dataObjectName = 'popup_' + targetSelector.slice(1);

    const type = window[dataObjectName] && window[dataObjectName].type ? window[dataObjectName].type : 'inline';

    $(this).magnificPopup({
        type: type,
        midClick: true,
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });
})
