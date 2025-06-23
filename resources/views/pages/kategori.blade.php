@extends('layouts.master') 

@section('content')




    @if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


<div class="container flex-grow-1 container-p-y">



  <div class="row">

    <div class="col-md-4">
      <h3 class="">Daftar Kategori</h3>
      
              <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Kategori
</button>

      <button id="exportExcel" class="btn btn-success mb-3">
        Excel
      </button>

      <div>
      <input type="text" id="searchBox" placeholder="Cari barang..." />

      </div>

    </div>
    <div class="col-md-12">
      <div class="card mb-4">
        <!-- Account -->
        <div class="card-body">
          
          <table id="myTable" class="display table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kategori }}</td>
                <td>
                  <button class="btn btn-warning btn-sm editKategori" data-id="{{ $item->id }}" data-kategori="{{ $item->kategori }}">
                    ✏️ Edit
                  </button>
                  <button class="btn btn-danger btn-sm deleteKategori" data-id="{{ $item->id }}">
                    🗑️ Delete
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('category.store') }}" >
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" class="form-control" name="kategori" placeholder="Masukkan nama kategori">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
        </form>

    </div>
  </div>
</div>

{{-- Modal Edit  --}}
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalEditLabel">Update Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <form id="formBarangUpdate" >
          @csrf

          <div class="modal-body">
  
            <div class="mb-3">
              <label for="kategori" class="form-label">Nama Kategori</label>
              <input type="text" class="form-control" name="kategori" placeholder="Masukkan nama kategori" required>
            </div>

             
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>



@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 
  <script>
   $(document).ready(function () {
        $('#myTable').DataTable({
          searching: false,
        });
      });
    // $('#formBarang').on('submit', function(e) {
    //   e.preventDefault();
    //   let form = $(this);
    //   let formData = form.serialize();

    //   console.log(formData);

    //   $.ajax({
    //     url: "{{ route('category.store') }}",
    //     type: "POST",
    //     data: formData,
    //     success: function(response) {
    //       toastr.success("Barang berhasil disimpan!");
    //       $('#exampleModal').modal('hide');
    //       form[0].reset(); // Reset form
    //       location.reload(); // Reload tabel otomatis
    //     },
    //     error: function(xhr) {
    //     if (xhr.status === 422) {
    //       // Validation errors
    //       let errors = xhr.responseJSON.errors;
    //       let message = '';
    //       for (let field in errors) {
    //         message += `${errors[field][0]} \n`;
    //       }
    //       toastr.error(message);

    //     } else {
    //       // Other server errors
    //       toastr.error(xhr.responseJSON.error || "Gagal menyimpan data!");
    //     }
    //   }
    //   });
    // });

    $('.editKategori').on('click', function () {
      let id = $(this).data('id');
      let kategori = $(this).data('kategori');

      $('#exampleModalEdit').modal('show');
      $('input[name="kategori"]').val(kategori);

      $('#formBarangUpdate').submit(function (e) {
        e.preventDefault();
        let url = $(this).attr('action');

        $.ajax({
          url: `/kategori/update/${id}`,
          method: 'PUT',
          data: $(this).serialize(),
          success: function () {
            toastr.success("Kategori berhasil diupdate!");
            $('#exampleModalEdit').modal('hide');
            setTimeout(() => {
              location.reload();
            }, 1000); // Reload halaman setelah 1 detik
          },
          error: function (xhr) {
            var errorMessage = xhr.responseJSON.error || "Gagal update data!";
            toastr.error(errorMessage); 
          }
        });
    });

    });

    $('.deleteKategori').on('click', function() {
      let id = $(this).data('id');
      if (confirm("Apakah kamu yakin ingin menghapus data ini?")) {
        $.ajax({
          url: `/kategori/delete/${id}`,
          type: "DELETE",
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          success: function(response) {
            toastr.success("Kategori berhasil dihapus!");
            location.reload();
          },
          error: function() {
            var errorMessage = xhr.responseJSON.error || "Gagal menghapus data!";
            toastr.error(errorMessage); 
          }
        });
      }
    });

      
      $('#exportExcel').on('click', function(e) {
        e.preventDefault();

        window.location.href = "/export";
      });

  </script>
@endsection