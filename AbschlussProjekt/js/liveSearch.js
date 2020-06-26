$(document).ready(function() {
    $('.search-box input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
        $.get("/php/Abschlussprojekt/inc/liveSearch.inc.php", { term: inputVal }).done(function (data) {
            console.log(data);
            resultDropdown.html(data);
        });
    }   else {
        resultDropdown.empty();
        }
});

 // Set search input value on click of result item
    $(document).on("click", ".result p", function () {
     $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
      $(this).parents(".result").empty();
    });
});