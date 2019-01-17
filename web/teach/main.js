function buttonClick() {
  alert("Clicked!");
}

$(function() {
  $("#changeColor").click(function() {
    var color = $("#color").val();
    $("#one").css("background-color", color);
  });
});
