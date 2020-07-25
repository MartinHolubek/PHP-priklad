$(function () {
    $("#send").click(function () {
        $.post({
                url: "pridajClanok.php",
                data: {
                    nadpis: $("#nadpis").val(),
                    popis: $("#popis").val(),
                    sekcia: $("#sekcia").val(),
                    op: "save"

                }
            }
        )
    })



    function getMessage () {
        $.get({
            url: "cyklistika.php",
            data: {op: 'get'},
            success: function (data) {
                data = $.parseJSON(data);
                html = '';
                for(i=0; i<data.length; i++) {
                    html += '[' + data[i].message_date + '] ' + data[i].nick + ': ' + data[i].message + '<br>';
                }
                $("#chat").html(html);
            }
        })
    }

    window.setInterval(getMessage, 2000)



});

$(document).ready(function() {
    $("#results" ).load( "skuska.php"); //load initial records

    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        var page = $(this).attr("data-page"); //get page number from link
        $("#results").load("skuska.php",{"page":page}, function(){ //get content from PHP page
            $(".loading-div").hide(); //once done, hide loading element
        });

    });
});
