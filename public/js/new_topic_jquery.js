$(document).ready(function() {
    $('#tags').tagsInput({
        'height':'100px',
        'width':'300px',
        'interactive':true,
        'defaultText':'',
        'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
        'removeWithBackspace' : true,
        'minChars' : 4,
        'maxChars' : 255, // if not provided there is no limit
        'placeholderColor' : '#666666'
    });
});
