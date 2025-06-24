@extends('layouts.dashboard')

@section('title', 'Keuangan - Lapak Tani')
@section('page-title', 'Manajemen Keuangan')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="bi bi-arrow-up-circle text-xl text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pemasukan</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($stats['total_income'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="bi bi-arrow-down-circle text-xl text-red-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pengeluaran</p>
                    <p class="text-2xl font-bold text-red-600">Rp {{ number_format($stats['total_expense'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="bi bi-bar-chart text-xl text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Keuntungan Bersih</p>
                    <p class="text-2xl font-bold {{ $stats['net_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format($stats['net_profit'], 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="bi bi-bag text-xl text-purple-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-between items-center">
        <div class="flex space-x-2">
            <select id="period-filter" class="form-select">
                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Tahun Ini</option>
            </select>
        </div>
        <a href="{{ route('petani.financial.create') }}" class="btn-primary">
            <i class="bi bi-plus mr-2"></i>
            Tambah Catatan
        </a>
    </div>

    <!-- Records Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Catatan Keuangan</h3>
        </div>
        
        @if($records->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($records as $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $record->transaction_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $record->type_badge }}">
                                        {{ $record->type_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->category }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($record->description, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $record->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $record->formatted_amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="deleteRecord({{ $record->id }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($records->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $records->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <i class="bi bi-currency-dollar text-5xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Catatan</h3>
                <p class="text-gray-500 mb-6">Mulai catat pemasukan dan pengeluaran Anda</p>
                <a href="{{ route('petani.financial.create') }}" class="btn-primary">
                    Tambah Catatan Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('period-filter').addEventListener('change', function() {
    window.location.href = '{{ route("petani.financial.index") }}?period=' + this.value;
});

function deleteRecord(id) {
    if (confirm('Hapus catatan keuangan ini?')) {
        fetch(`/petani/keuangan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
            }
        });
    }
}
</script>
@endsection
