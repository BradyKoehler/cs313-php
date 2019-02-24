$("#new-note").click(function() {
  var content = $("#note-new").val()
      id = $("div.note-view").attr("data-id");
  $.post("notes/create.php", { id: id, content: content }, function(data) {
    data = JSON.parse(data);
    $("#note-new").parent().after(`<div class='note'><p><a href='users/view.php?id=${data.user_id}'>${data.username}</a><span style='float: right;'>${data.created_at}</span></p><p>${data.content}</p></div>`);
    $("#note-new").val('');
  });
});
