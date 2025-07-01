{{-- Ganti dengan layout utama Anda jika ada --}}
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Absen Bermasalah</title>
    {{-- Tambahkan link CSS seperti Bootstrap untuk styling --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">

    {{-- Header Biru Sesuai Gambar --}}
    <div class="bg-primary text-white p-2 mb-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Absen Bermasalah</h5>
        <span style="cursor: pointer;">&minus;</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    {{-- Kontrol di atas tabel --}}
    <div class="d-flex justify-content-between mb-3">
        <div>
            {{-- Tombol Input di kiri atas --}}
            <a href="{{ route('absen-bermasalah.create') }}" class="btn btn-primary">Input Absen Bermasalah</a>
        </div>
        <div>
            <form>
                <label for="search">Search:</label>
                <input type="search" id="search" class="form-control-sm">
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Keterangan</th>
                <th>Keterangan</th>
                <th>Lokasi <span class="text-muted">↕</span></th>
                <th>Tanggal Bermasalah</th>
                <th>Shift <span class="text-muted">↕</span></th>
                <th>Kondisi</th>
                <th>Petugas Input <span class="text-muted">↕</span></th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataAbsen as $item)
            <tr>
                <td>{{ $dataAbsen->firstItem() + $loop->index }}</td>
                <td>{{ $item->kode_keterangan }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->format('Y-m-d') }} / {{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('Y-m-d') }}</td>
                <td>{{ $item->shift }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->petugas_input }}</td>
                <td>
                    {{-- Tombol Aksi dikembalikan menjadi button --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('absen-bermasalah.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('absen-bermasalah.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

     {{-- Paginasi dan Kontrol di bawah tabel --}}
     <div class="d-flex justify-content-between align-items-center">
        <div>
            Showing {{ $dataAbsen->firstItem() }} to {{ $dataAbsen->lastItem() }} of {{ $dataAbsen->total() }} entries
        </div>
        <div class="d-flex align-items-center gap-3">
            {{-- Records per page di kanan bawah --}}
            <div>
                <select class="form-select-sm">
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                records per page
            </div>
            <div>
                {!! $dataAbsen->links() !!}
            </div>
        </div>
    </div>
</div>
</body>
</html>