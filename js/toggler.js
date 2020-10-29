$(document).ready(function () {
	// Toggle the sidebar on Desktop screens
	$("#sidebar-toggler-desk").click(function (e) {
	  e.preventDefault();
	  $(".sidebar").fadeToggle();
	  $(".main-area").toggleClass("col-sm-12", "col-sm-10");
	});
  
	// Toggle on mobile
	$("#sidebar-toggler-sm").click(function () {
	  $(".sidebar").fadeToggle();
	});
  });