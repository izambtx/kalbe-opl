const flashData = $('.flash-data').data('flashdata');
const flashRealisasi = $('.flash-realisasi').data('flashdata');

if (flashData) {
    Swal.fire({
        icon: 'success',
        title: 'SUCCESS',
        text: flashData,
        showConfirmButton: false,
        customClass: 'pb-4 rounded-md',
        timer: 2500
      })
}

if (flashRealisasi) {

  Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
}

//tombol hapus
$('tombol-hapus').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
});