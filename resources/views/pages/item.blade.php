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
      <h3 class="mt-5 mb-5">Daftar Barang</h3>
      
              <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Tambah
      </button>

      <button id="exportExcel" class="btn btn-success mb-3">
        Excel
      </button>

      <div>
      <input type="text" id="searchNamaBarang" class="form-control mb-2" placeholder="Cari nama barang...">
        <small id="searchTime" class="text-muted"></small>

      <div id="searchNarration" class="mt-3 border p-3 rounded bg-light mb-3" style="display: none;">
        <strong>🔍 Tahapan Algoritma Sequential Search:</strong>
        <div id="stepsText" class="mt-2" style="white-space: pre-line; font-family: monospace;"></div>
      </div>





      </div>

    </div>
    <div class="col-md-12">
      <div class="card mb-4">
        <!-- Account -->
        <div class="card-body">
          
          <table id="myTable" class="display table table-striped">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Deskripsi</th>
                <th>Penerima</th>
                <th>Dibuat tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barang as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category_name }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->penerima }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>



                <td>
                  <button class="btn btn-warning btn-sm editBarang" data-id="{{ $item->id }}" data-nama="{{ $item->name }}" data-kategori="{{ $item->category_name }}" data-lokasi="{{ $item->lokasi }}" data-qty="{{ $item->quantity }}"  data-satuan="{{ $item->satuan }}" data-deskripsi="{{ $item->description }}" data-penerima="{{ $item->penerima }}">
                    ✏️ Edit
                  </button>
                  <button class="btn btn-danger btn-sm deleteBarang" data-id="{{ $item->id }}">
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

<!-- {{-- Modal Edit  --}} -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalEditLabel">Update Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <form id="formBarangUpdate" method="POST">
          @csrf

          <div class="modal-body">
  
            <div class="mb-3">
              <label for="nama_barang" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan nama barang" required>
            </div>

             <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori" required>
            </div>

             <div class="mb-3">
              <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" class="form-control" name="lokasi" placeholder="Masukkan lokasi" required>
            </div>
            
            
            <div class="mb-3">
              <label for="qty" class="form-label">Qty</label>
              <input type="number" class="form-control" name="qty" placeholder="Masukkan jumlah qty" required>
            </div>

            <div class="mb-3">
              <label for="satuan" class="form-label">Satuan</label>
              <input type="text" class="form-control" name="satuan" placeholder="Masukkan jumlah satuan" required>
            </div>
  
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi barang"></textarea>
            </div>

            <div class="mb-3">
              <label for="penerima" class="form-label">Penerima</label>
              <input type="text" class="form-control" name="penerima" placeholder="Masukkan nama penerima" required>
            </div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('item.store') }}">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama_barang" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan nama barang" required>
            </div>

             <div class="mb-3">
              <label for="nama_barang" class="form-label">Kategori</label>
              <select class="form-control" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" class="form-control" name="lokasi" placeholder="Masukkan lokasi" required>
            </div>

            <div class="mb-3">
              <label for="qty" class="form-label">Qty</label>
              <input type="number" class="form-control" name="qty" placeholder="Masukkan Qty" required>
            </div>

            <div class="mb-3">
              <label for="satuan" class="form-label">Satuan</label>
              <input type="text" class="form-control" name="satuan" placeholder="Masukkan satuan" required>
            </div>

             <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi barang"></textarea>
            </div>

             <div class="mb-3">
              <label for="penerima" class="form-label">Penerima</label>
              <input type="text" class="form-control" name="penerima" placeholder="Masukkan Nama Penerima" required>
            </div>
  
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

    $('#searchNamaBarang').on('keyup', function () {
      $('#searchNarration').show();
      const keyword = $(this).val().toLowerCase();
      const rows = $('#myTable tbody tr');
      let narration = '';
      let found = false;
      const startTime = performance.now();

      rows.each(function (index) {
        const row = $(this);
        const namaBarang = row.find('td:nth-child(1)').text().toLowerCase();

        narration += `Cek baris[${index}] → "${namaBarang}" `;
        if (namaBarang.includes(keyword)) {
          narration += `✅ cocok → berhenti dan tampilkan\n`;
          row.show();
          found = true;
        } else {
          narration += `❌ tidak cocok → lanjut\n`;
          row.hide();
        }
      });

      if (!found && keyword !== '') {
        narration += `🔴 Barang tidak ditemukan dalam seluruh baris.\n`;
      }

      const endTime = performance.now();
      const duration = (endTime - startTime).toFixed(2);

      $('#stepsText').text(narration);
      $('#searchTime').text(`Waktu pencarian: ${duration} ms`);
    });





        $('#myTable').DataTable({
          searching: false,
          paging:false
          
        });
      });
    // $('#formBarang').on('submit', function(e) {
    //   e.preventDefault();
    //   let form = $(this);
    //   let formData = form.serialize();

    //   console.log(formData);

    //   $.ajax({
    //     url: "{{ route('item.store') }}",
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

    $('.editBarang').on('click', function () {
      let id = $(this).data('id');
      let nama = $(this).data('nama');
      let kategori = $(this).data('kategori');
      let lokasi = $(this).data('lokasi');
      let qty = $(this).data('qty');
      let satuan = $(this).data('satuan');
      let deskripsi = $(this).data('deskripsi');
      let penerima = $(this).data('penerima');

      console.log(id)

      $('#exampleModalEdit').modal('show');
      $('input[name="nama_barang"]').val(nama);
      $('input[name="kategori"]').val(kategori);
      $('input[name="lokasi"]').val(lokasi);
      $('input[name="qty"]').val(qty);
      $('input[name="satuan"]').val(satuan);
      $('textarea[name="deskripsi"]').val(deskripsi);
      $('input[name="penerima"]').val(penerima);

      $('#formBarangUpdate').submit(function (e) {
        e.preventDefault();
        let url = $(this).attr('action');

        $.ajax({
          url: `/barang/update/${id}`,
          method: 'POST',
          data: $(this).serialize(),
          success: function () {
            toastr.success("Barang berhasil diupdate!");
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

    $('.deleteBarang').on('click', function() {
      let id = $(this).data('id');
      if (confirm("Apakah kamu yakin ingin menghapus data ini?")) {
        $.ajax({
          url: `/barang/delete/${id}`,
          type: "DELETE",
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          success: function(response) {
            toastr.success("Barang berhasil dihapus!");
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