// Ambil tombol edit
var editButtons = document.querySelectorAll('.editBtn');

// Tambahkan event listener untuk setiap tombol edit
editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var id = button.getAttribute('data-id');
        openEditModal(id);
    });
});

// Fungsi untuk membuka modal edit
function openEditModal(id) {
    var modal = document.getElementById('editModal');
    modal.style.display = 'block';

    // Ambil data pasien yang akan diedit menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var data = JSON.parse(this.responseText);
            populateEditForm(data);
        }
    };
    xhr.open("GET", "get_patient.php?id=" + id, true); // Ganti 'get_patient.php' dengan skrip PHP yang akan Anda buat untuk mengambil data pasien berdasarkan ID
    xhr.send();
}

// Fungsi untuk mengisi formulir edit dengan data pasien yang akan diedit
function populateEditForm(data) {
    document.getElementById('editId').value = data.id;
    document.getElementById('editNama').value = data.nama;
    document.getElementById('editTanggalLahir').value = data.tanggal_lahir;
    document.getElementById('editAlamat').value = data.alamat;
    document.getElementById('editJenisKelamin').value = data.jenis_kelamin;
    document.getElementById('editNomorTelepon').value = data.nomor_telepon;
}
