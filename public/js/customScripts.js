$("#description").ready(function () {
   let maxLength = 250;
   let length = $(this).val().length;
   let res = maxLength - length;
   $("#charNum").text(res);
});
