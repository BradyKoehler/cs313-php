$(function() {
  function addItem(item, elem) {
    $.post("add.php", { item: item })
      .done(function(data) {
        $("#itemCount").html(`(${data})`);
        if (elem) $(elem).parent().attr("data-status", "in-cart");
      })
      .fail(function(xhr, status, error) {
        switch(xhr.status) {
          case 409:
            alert("Item already in cart");
            break;
          default:
            alert("Item could not be added to cart");
        }
      });
  }
  
  $('button.add').click(function() {
    var item = this.dataset.item,
        elem = this;

    addItem(item, elem);
  });
});
