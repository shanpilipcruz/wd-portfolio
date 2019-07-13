$(document).ready(function(){
    $("#description").on('keyup',function () {
        let maxLength = 250;
        let length = $(this).val().length;
        let res = maxLength - length;
        $("#charNum").text(res);
    });
});

$(document).ready(function(){
    $("#ProjectDescription").on('keyup',function () {
        let maxLength = 250;
        let length = $(this).val().length;
        let res = maxLength - length;
        $("#characterCount").text(res);
    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
