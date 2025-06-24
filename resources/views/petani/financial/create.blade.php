@extends('layouts.dashboard')

@section('title', 'Tambah Catatan Keuangan - Lapak Tani')
@section('page-title', 'Tambah Catatan Keuangan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Tambah Catatan Keuangan</h3>
        </div>
        
        <form id="financial-form" class="p-6 space-y-6">
            @csrf
            
            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Transaksi</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Pilih Tipe</option>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="form-textarea" 
                          placeholder="Jelaskan detail transaksi..." required></textarea>
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah (Rp)</label>
                <input type="number" id="amount" name="amount" class="form-input" 
                       placeholder="0" min="0" step="0.01" required>
            </div>

            <!-- Transaction Date -->
            <div>
                <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Transaksi</label>
                <input type="date" id="transaction_date" name="transaction_date" class="form-input" 
                       value="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('petani.financial.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Simpan Catatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const incomeCategories = [
    'Penjualan Produk',
    'Bonus/Insentif',
    'Subsidi Pemerintah',
    'Pinjaman',
    'Lainnya'
];

const expenseCategories = [
    'Bibit/Benih',
    'Pupuk',
    'Pestisida',
    'Peralatan',
    'Tenaga Kerja',
    'Transportasi',
    'Kemasan',
    'Listrik/Air',
    'Sewa Lahan',
    'Lainnya'
];

document.getElementById('type').addEventListener('change', function() {
    const categorySelect = document.getElementById('category');
    const categories = this.value === 'income' ? incomeCategories : expenseCategories;
    
    categorySelect.innerHTML = '<option value="">Pilih Kategori</option>';
    categories.forEach(category => {
        categorySelect.innerHTML += `<option value="${category}">${category}</option>`;
    });
});

document.getElementById('financial-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    submitButton.disabled = true;
    submitButton.textContent = 'Menyimpan...';
    
    fetch('{{ route("petani.financial.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan');
    })
    .finally(() => {
        submitButton.disabled = false;
        submitButton.textContent = originalText;
    });
});
</script>
@endsection
