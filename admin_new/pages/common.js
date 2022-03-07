
let openmd = function() {
  $("#exampleModalas").modal("show");
};

let closemd = function(form_id) {
  $("#exampleModalas").modal("hide");
  resetForm(form_id);
};

function resetForm(form_id) {
  $(":input", form_id)
    .not(":button, :submit, :reset, :hidden")
    .val("")
    .prop("checked", false)
    .prop("selected", false);
}

function checkAll(tableID) {
  var table = document.getElementById(tableID);
  var val = table.rows[0].cells[0].children[0].checked;
  for(var i = 1; i < table.rows.length; i++) {
    table.rows[i].cells[0].children[0].checked = val;
  }
}

