(function() {
  var editor = document.querySelector("#css-editor textarea");
  var sheet = document.createElement('style');

  document.body.appendChild(sheet);

  function updateCustomStyle() {
    sheet.innerHTML = editor.value;
  }

  editor.addEventListener("keydown", updateCustomStyle);
})();
