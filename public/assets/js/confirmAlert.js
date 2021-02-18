$('.btn-delete').click(function() {
    let that = $(this);
    Swal.fire({
        title: 'Confirmation Delete',
        text: "Are you sure delete this data?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        showLoaderOnConfirm: true
    }).then((result) => {
        if (result.value) {
          that.parent('form').submit();

        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          Swal.fire(
            'Cancelled',
            'Data is save!',
            'error'
          )
        }
})
})

$(document).ready(function() {
    $('.btnSubmit').click(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        Swal.fire({
            title: 'Konfirmasi Submit',
            text: "Apakah anda yakin ingin membeli product ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                $('#formSubmit').submit();

            }else if (
                result.dismiss === Swal.DismissReason.cancel

              ) {

              }
        })
    })
})

$(document).ready(function() {
    $('.btnEdit').click(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        Swal.fire({
            title: 'Konfirmasi Submit',
            text: "Apakah anda yakin ingin update data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                $('#formSubmit').submit();

            }else if (
                result.dismiss === Swal.DismissReason.cancel

              ) {
                Swal.fire(
                  'Cancelled',
                  'Submit di cancel, silahkan cek dan masukkan data anda dengan benar',
                  'info'
                )
              }
        })
    })
})
