function buttonClick() {
  alert("Clicked!");
}

$(function() {
  $("#changeColor").click(function() {
    var color = $("#color").val();
    $("#one").css("background-color", color);
  });

  $("#goaway").click(function() {
    $("#three").fadeOut(500);
    $(this).hide();
    $("#comeback").show();
  });

  $("#comeback").click(function() {
    $("#three").fadeIn(500);
    $(this).hide();
    $("#goaway").show();
  });
});
