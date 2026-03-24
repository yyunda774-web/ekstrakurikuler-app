<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; }
        .title { font-size: 20px; margin: 20px 0; }
        .content { margin: 30px 0; }
        .field { margin: 10px 0; }
        .label { font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; }
        .border { border: 2px solid #000; padding: 20px; }
        .qrcode { text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="border">
        <div class="header">
            <div class="logo">SMA NEGERI 1 CONTOH</div>
            <div class="title">BUKTI PENDAFTARAN EKSTRAKURIKULER</div>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">Kode Pendaftaran:</span> {{ $pendaftaran->kode_pendaftaran }}
            </div>
            <div class="field">
                <span class="label">Nama Siswa:</span> {{ $pendaftaran->user->name }}
            </div>
            <div class="field">
                <span class="label">NIS:</span> {{ $pendaftaran->user->nis }}
            </div>
            <div class="field">
                <span class="label">Kelas:</span> {{ $pendaftaran->user->kelas }}
            </div>
            <div class="field">
                <span class="label">Ekstrakurikuler:</span> {{ $pendaftaran->ekstrakurikuler->nama }}
            </div>
            <div class="field">
                <span class="label">Pembina:</span> {{ $pendaftaran->ekstrakurikuler->pembina }}
            </div>
            <div class="field">
                <span class="label">Jadwal:</span> {{ $pendaftaran->ekstrakurikuler->hari }}, {{ $pendaftaran->ekstrakurikuler->waktu }}
            </div>
            <div class="field">
                <span class="label">Tanggal Daftar:</span> {{ $pendaftaran->tanggal_daftar->format('d/m/Y H:i') }}
            </div>
            <div class="field">
                <span class="label">Status:</span> 
                <strong>{{ strtoupper($pendaftaran->status) }}</strong>
            </div>
        </div>
        
        <div class="qrcode">
            <!-- QR Code akan ditempatkan di sini -->
            <div style="border: 1px dashed #000; width: 150px; height: 150px; margin: 0 auto;">
                QR Code: {{ $pendaftaran->kode_pendaftaran }}
            </div>
        </div>
        
        <div class="footer">
            <p>Bukti ini sah dan dapat digunakan sebagai bukti pendaftaran</p>
            <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>