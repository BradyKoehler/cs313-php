function undoRemoval(elem) {
  var item = elem.dataset.item;

  $.post("add.php", { item: item, undo: true })
    .done(function(data) {
      data = JSON.parse(data);
      var html = "<img src='img/" + item
        + ".jpg' /><p><b>" + data.name + "</b><span class='price'>"
        + data.price + "</span></p><button class='remove' data-item='"
        + item + "'>Remove</button>";
      $("#itemCount").html(data.count);
      $("#totalCost").html(data.sum);
      $(elem).parent().attr("class", "list-item");
      $(elem).parent().html(html);
    })
    .fail(function(xhr, status, error) {
      alert("Item could not be added to cart");
    });
}

$(function() {
  $(document).on('click', 'button.remove', function() {
    var item = this.dataset.item,
        elem = this,
        name = $(this).parent().children("p").children("b").text(),
        html = "<p><i>The " + name + " has been removed, click to undo.</i></p>"
          + "<button class='default' onclick='undoRemoval(this)' data-item='"
          + this.dataset.item + "'>Undo</button>";

    $.post("remove.php", { item: item })
      .done(function(data) {
        data = JSON.parse(data);
        $("#itemCount").html(data.count);
        $("#totalCost").html(data.price);
        // $(elem).parent().remove();
        $(elem).parent().addClass("undo");
        $(elem).parent().html(html);
      })
      .fail(function(xhr, status, error) {
        switch(xhr.status) {
          case 404:
            alert("Item not found");
            break;
          default:
            alert("Item could not be removed from cart");
        }
      });
  });
});
