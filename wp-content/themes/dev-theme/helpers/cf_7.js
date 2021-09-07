//----------cf7 file upload name
$(".form_field_file").change(function (e) {
  var fileNameText = $(".form_field_file_title").html();
  var fileName = $(this).val().split("\\").pop();
  if(fileName || fileName != '') {
    $(".form_field_file.input_file_cta").text(fileName);
  } else {
    $(".form_field_file.input_file_cta").html(fileNameText);
  }
});

//----------cf7 mailsent func
$(".wpcf7").on('wpcf7mailsent', function(event){
	$(".popupContact").removeClass("active_mod");
	$(".popupSuccess").addClass("active_mod");
});