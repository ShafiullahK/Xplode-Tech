$(document).ready(function() {
    $("#printBtn").click(function(e) {
     $("#sidebar-toggler").addClass("no-print");
        e.preventDefault();

// Print mode
$(".sidebar").css({ display: "none" });
    $("#right-area")
        .removeClass("col-sm-10")
            .addClass("col-sm-12");

    window.print();

// Normal mode
$(".sidebar").css({ display: "block" });
    $("#right-area")
        .addClass("col-sm-10")
        .removeClass("col-sm-12");
});

});