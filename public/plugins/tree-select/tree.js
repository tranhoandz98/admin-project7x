// tree selec
$(document).on('click', 'button', function(e) {
    switch ($(this).text()) {
      case 'Checked All':
        $(".treeview input[type='checkbox']").prop('checked', true);
        break;
      case 'Unchek All':
        $(".treeview input[type='checkbox']").prop('checked', false);
        break;
      default:
    }
  });

