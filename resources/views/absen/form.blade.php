<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($absen) ? 'Edit' : 'Input' }} Absen Bermasalah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4 mb-4">
    
    {{-- Header Merah Sesuai Gambar --}}
    <div class="bg-danger text-white p-3 mb-4">
        <h4 class="mb-0">INPUT ABSEN BERMASALAH</h4>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($absen) ? route('absen-bermasalah.update', $absen->id) : route('absen-bermasalah.store') }}" method="POST">
        @csrf
        @if(isset($absen))
            @method('PUT')
        @endif

        {{-- Menggunakan Grid System Bootstrap untuk Layout 2 Kolom --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kode_keterangan" class="form-label">No Keterangan</label>
                <input type="text" class="form-control" id="kode_keterangan" name="kode_keterangan" value="{{ old('kode_keterangan', $absen->kode_keterangan ?? '') }}" placeholder="Contoh: C1-20251220-01" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal', isset($absen) ? \Carbon\Carbon::parse($absen->tanggal_awal)->format('Y-m-d') : '') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="keterangan" class="form-label">Keterangan Absen Bermasalah</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $absen->keterangan ?? '') }}" placeholder="Keterangan Surat Tugas" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir', isset($absen) ? \Carbon\Carbon::parse($absen->tanggal_akhir)->format('Y-m-d') : '') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lokasi" class="form-label">Lokasi Kampus*</label>
                <select name="lokasi" id="lokasi" class="form-select" required>
                    <option value="">-- Pilih Lokasi --</option>
                    @php
                        $lokasiOptions = ['Fatmawati A', 'Ciledug', 'Kramat', 'Margonda'];
                    @endphp
                    @foreach($lokasiOptions as $option)
                        <option value="{{ $option }}" {{ old('lokasi', $absen->lokasi ?? '') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="shift" class="form-label">Pilih Shift Kerja*</label>
                <select name="shift" id="shift" class="form-select" required>
                     <option value="">-- Pilih Shift --</option>
                    <option value="1A (07:30:00 - 16:30:00) Jam Kerja Shift Pagi" {{ old('shift', $absen->shift ?? '') == '1A (07:30:00 - 16:30:00) Jam Kerja Shift Pagi' ? 'selected' : '' }}>1A (07:30 - 16:30) Jam Kerja Shift Pagi</option>
                    <option value="2A (16:30:00 - 20:30:00) Jam Kerja Shift Siang" {{ old('shift', $absen->shift ?? '') == '2A (16:30:00 - 20:30:00) Jam Kerja Shift Siang' ? 'selected' : '' }}>2A (16:30:00 - 20:30:00) Jam Kerja Shift Siang</option>
                </select>
            </div>
        </div>
        
        <div class="row">
             <div class="col-md-6 mb-3">
                <label for="petugas_input" class="form-label">Petugas Input</label>
                <input type="text" class="form-control" id="petugas_input" name="petugas_input" value="{{ old('petugas_input', $absen->petugas_input ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Kondisi*</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi" id="kondisiMasuk" value="Absen Masuk" {{ old('kondisi', $absen->kondisi ?? '') == 'Absen Masuk' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="kondisiMasuk">[1] Absen Masuk</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi" id="kondisiTengah" value="Absen Tengah" {{ old('kondisi', $absen->kondisi ?? '') == 'Absen Tengah' ? 'checked' : '' }}>
                    <label class="form-check-label" for="kondisiTengah">[2] Absen Tengah</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi" id="kondisiPulang" value="Absen Pulang" {{ old('kondisi', $absen->kondisi ?? '') == 'Absen Pulang' ? 'checked' : '' }}>
                    <label class="form-check-label" for="kondisiPulang">[3] Absen Pulang</label>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('absen-bermasalah.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>