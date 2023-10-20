@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 border-end">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Filter Jenis Obat</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label for="jenis-obat">Pilih Jenis Obat:</label>
                            <select id="jenis-obat" class="form-select">
                                <option value="all">Semua Jenis</option>
                                <option value="Kapsul">Kapsul</option>
                                <option value="Larutan">Larutan</option>
                                <option value="Bubuk">Bubuk</option>
                                <!-- Tambahkan opsi untuk jenis obat lainnya jika diperlukan -->
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Keranjang -->
            <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">Keranjang</h5>
                        <ul class="list-group" id="cart-list">
                            <!-- Item keranjang akan ditambahkan di sini -->
                        </ul>
                        <p>Total Harga: <span id="total-price">0</span></p>
                        <button class="btn btn-success btn-checkout">Checkout</button>
                    </div>
                </div>
        </div>

        <!-- Daftar Obat -->
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
                @foreach($obats as $obat)
                <div class="col">
                    <div class="text-center card h-100">
                        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                            <img src="{{ asset('uploads/' . $obat->gambar) }}" alt="{{ $obat->nama }}" width="150">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$obat->nama}}</h5>
                            <p class="card-text">{{$obat->harga}}</p>
                            <button class="btn btn-primary btn-add-to-cart" data-id="{{ $obat->id }}">Tambahkan ke Keranjang</button>
                            <input type="hidden" id="kategori-obat" value="{{ $obat->kategori }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="checkoutModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Daftar Obat dalam Keranjang:</h6>
                    <ul id="keranjangItemList">
                        <!-- Daftar obat dalam keranjang akan ditampilkan di sini -->
                    </ul>
                    <h6>Total Harga: <span id="totalHargaModal">0</span></h6>
                    <input type="text" class="form-control" id="namaPembeli" placeholder="Nama Anda">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="confirmCheckout">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Tambahkan script di bagian bawah tampilan Anda -->
<script>
    // Mendengarkan perubahan pada elemen <select>
    $('#jenis-obat').change(function () {
        const selectedJenisObat = $(this).val(); // Mendapatkan nilai yang dipilih

        // Loop melalui semua kartu obat
        $('.col-md-9 .col').each(function () {
            const kategoriObat = $(this).find('#kategori-obat').val();
            const card = $(this);

            // Periksa apakah obat sesuai dengan jenis yang dipilih
            if (selectedJenisObat === 'all' || kategoriObat === selectedJenisObat) {
                card.show(); // Tampilkan kartu obat
            } else {
                card.hide(); // Sembunyikan kartu obat yang tidak sesuai
            }
        });
    });

    const cartList = document.getElementById('cart-list');
    const totalHargaElement = document.getElementById('total-price');
    const btnCheckout = document.querySelector('.btn-checkout');
    btnCheckout.disabled = true;

    const keranjang = []; // Array untuk menyimpan item dalam keranjang
    let totalHarga = 0;

    function tambahKeKeranjang(nama, harga) {
        const item = keranjang.find(item => item.nama === nama);

        if (item) {
            // Item sudah ada dalam keranjang, tingkatkan jumlahnya
            item.jumlah++;
            const itemElement = document.querySelector(`#cart-list li[data-name="${nama}"]`);
            if (itemElement) {
                itemElement.innerHTML = `
                    ${nama}
                    <span class="badge bg-primary rounded-pill">Rp${harga} x${item.jumlah}</span>
                    <button class="btn btn-primary btn-sm min-item">-</button>
                `;
            }
        } else {
            // Item belum ada dalam keranjang, tambahkan ke keranjang
            const newItem = {
                nama: nama,
                harga: harga,
                jumlah: 1
            };
            keranjang.push(newItem);

            // Buat elemen "li" untuk item baru
            const itemElement = document.createElement('li');
            itemElement.className = 'list-group-item d-flex justify-content-between align-items-center';
            itemElement.setAttribute('data-name', nama);
            itemElement.setAttribute('data-harga', harga);
            itemElement.innerHTML = `
                ${nama}
                <span class="badge bg-primary rounded-pill">Rp${harga} x${newItem.jumlah}</span>
                <button class="btn btn-primary btn-sm min-item">-</button>
            `;
            cartList.appendChild(itemElement);
        }

        // Menghitung total harga
        totalHarga += harga;
        totalHargaElement.textContent = totalHarga;

        // Mengaktifkan tombol Checkout
        btnCheckout.disabled = false;
        }

    // Fungsi untuk mengurangi jumlah obat dalam keranjang

    function kurangiDariKeranjang(nama, harga) {
        const item = keranjang.find(item => item.nama === nama);

        if (item) {
            // Item ada dalam keranjang
            if (item.jumlah > 1) {
                // Jika jumlah lebih dari 1, kurangi jumlahnya
                item.jumlah--;

                // Perbarui jumlah dalam tampilan
                const itemElement = document.querySelector(`#cart-list li[data-name="${nama}"]`);
                if (itemElement) {
                    itemElement.querySelector('span').textContent = `Rp${harga} x${item.jumlah}`;
                }
            } else {
                // Jika jumlah adalah 1, hapus elemen tombol min-item dan elemen dari tampilan
                const itemIndex = keranjang.indexOf(item);
                keranjang.splice(itemIndex, 1);
                const itemElement = document.querySelector(`#cart-list li[data-name="${nama}"]`);
                if (itemElement) {
                    itemElement.remove();
                }
            }

            // Menghitung total harga
            totalHarga -= harga;
            totalHargaElement.textContent = totalHarga;

            // Periksa apakah keranjang kosong
            if (keranjang.length === 0) {
                btnCheckout.disabled = true;
            }
        }
    }
    
    // Menambahkan event listener ke setiap tombol "Tambahkan ke Keranjang"
    $(document).ready(function() {
        $('.btn-add-to-cart').click(function() {
            var obatNama = $(this).closest('.col').find('.card-title').text();
            var obatHarga = parseFloat($(this).closest('.col').find('.card-text').text());
            tambahKeKeranjang(obatNama, obatHarga);
        });
    });


   $(document).on('click', '.min-item', function(){
        const item = this.closest('li');
        const nama = item.getAttribute('data-name');
        const harga = parseFloat(item.getAttribute('data-harga'));
        kurangiDariKeranjang(nama, harga);
   })

    // Menambahkan event listener ke tombol Checkout 
    $(document).on('click', '.btn-checkout', function(){ 
        $('#checkoutModal').modal('show');
        
        $('#keranjangItemList').empty();
        // Menampilkan daftar obat dalam keranjang dalam modal
        keranjang.forEach(function (item) {
            $('#keranjangItemList').append(`<li>${item.nama} - Rp${item.harga} x${item.jumlah}</li>`);
    });

    // Memperbarui total harga dalam modal
    $('#totalHargaModal').text(totalHarga);
    })
          
    $('#confirmCheckout').click(function () {
        const namaPembeli = $('#namaPembeli').val();        
            
        // Mengirim data transaksi ke server menggunakan AJAX
        $.ajax({
            url: '{{ url("/store") }}',
            method: 'POST', 
            data: {
                Nama_Pembeli: namaPembeli,
                Total_Harga: totalHarga,
                Transaksi: keranjang,          
                _token: '{{ csrf_token() }}'
            }, 
            success: function (response) {
                alert('Transaksi berhasil disimpan.');

                // Setelah transaksi berhasil, Anda bisa menjalankan langkah-langkah tambahan, seperti membersihkan keranjang, menampilkan notifikasi, atau mengarahkan pengguna ke halaman terima kasih.
                keranjang.length = 0; // Mengosongkan keranjang
                totalHarga = 0; // Mereset total harga
                totalHargaElement.textContent = totalHarga; // Memperbarui tampilan total harga
                btnCheckout.disabled = true; // Menonaktifkan tombol Checkout
                $('#cart-list').empty();
                $('#namaPembeli').val('');

                // Sembunyikan modal
                $('#checkoutModal').modal('hide');
            },
            error: function (error) {
                console.error('Terjadi kesalahan saat mengirim transaksi:', error);           
                alert('Transaksi gagal. Silakan coba lagi.');
            }
        });
    });

</script>
@endsection
