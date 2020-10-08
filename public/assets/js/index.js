$('.widget-content .warning.confirm.lock').on('click', function () {
    swal({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Unlock',
        padding: '2em'
      }).then(function(result) {
        if (result.value) {
          swal(
            'Unlock',
            'Unlock has been success.',
            'success'
          )
        }
      });
      $('.swal2-confirm .swal2-styled')
  })
  $('.widget-content .warning.confirm.unlock').on('click', function () {
    swal({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Lock',
        padding: '2em'
      }).then(function(result) {
        if (result.value) {
          swal(
            'Lock',
            'Lock has been success.',
            'success'
          )
        }
      })
  })

