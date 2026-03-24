@extends('layouts.guest')

@section('title', 'Scan QR Code Pendaftaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">
                    <i class="fas fa-qrcode me-2"></i>Scan QR Code
                </h1>
                <p class="text-muted">
                    Scan kode QR dari bukti pendaftaran untuk melihat status secara instan
                </p>
            </div>

            <!-- Main Card -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-camera me-2"></i>Pemindai QR Code
                    </h4>
                </div>
                
                <div class="card-body p-5">
                    <!-- QR Scanner Area -->
                    <div class="text-center mb-4">
                        <div id="qr-scanner-container" class="mb-4">
                            <div id="reader" style="width: 100%; max-width: 400px; margin: 0 auto;"></div>
                        </div>
                        
                        <div id="scanner-status" class="alert alert-info d-none">
                            <i class="fas fa-spinner fa-spin me-2"></i>
                            <span id="status-text">Memindai QR Code...</span>
                        </div>
                    </div>

                    <!-- Manual Input -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="text-center mb-4">
                            <i class="fas fa-keyboard me-2"></i>Atau Masukkan Manual
                        </h5>
                        
                        <form id="manual-form" method="POST" action="{{ route('cek-status.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Kode Pendaftaran</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-barcode"></i>
                                    </span>
                                    <input type="text" 
                                           id="manual-kode" 
                                           name="kode_pendaftaran"
                                           class="form-control"
                                           placeholder="REG-ABCD1234"
                                           required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Cek Status
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Instructions -->
                    <div class="mt-4">
                        <div class="alert alert-light">
                            <h6><i class="fas fa-info-circle me-2"></i>Cara Menggunakan:</h6>
                            <ol class="mb-0 ps-3">
                                <li>Arahkan kamera ke QR Code pada bukti pendaftaran</li>
                                <li>Tunggu hingga pemindaian selesai</li>
                                <li>Atau masukkan kode secara manual di form atas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-center mt-4">
                <a href="{{ route('cek-status') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-search me-1"></i>Cek Status Manual
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">
                    <i class="fas fa-home me-1"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- HTML5 QR Code Scanner Library -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    let html5QrCode;
    
    function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning
        html5QrCode.stop();
        
        // Show success status
        const statusEl = document.getElementById('scanner-status');
        const statusText = document.getElementById('status-text');
        statusEl.classList.remove('alert-info', 'd-none');
        statusEl.classList.add('alert-success');
        statusText.innerHTML = `<i class="fas fa-check me-2"></i>QR Code berhasil dipindai!`;
        
        // Auto submit form with scanned code
        setTimeout(() => {
            document.getElementById('manual-kode').value = decodedText;
            document.getElementById('manual-form').submit();
        }, 1000);
    }
    
    function onScanFailure(error) {
        // Handle scan failure
        console.warn(`QR Scan error: ${error}`);
    }
    
    // Initialize scanner when page loads
    document.addEventListener('DOMContentLoaded', function() {
        html5QrCode = new Html5Qrcode("reader");
        
        const config = { 
            fps: 10, 
            qrbox: { width: 250, height: 250 } 
        };
        
        // Start scanner
        html5QrCode.start(
            { facingMode: "environment" }, 
            config, 
            onScanSuccess, 
            onScanFailure
        );
        
        // Show status
        document.getElementById('scanner-status').classList.remove('d-none');
    });
    
    // Stop scanner when leaving page
    window.addEventListener('beforeunload', function() {
        if (html5QrCode) {
            html5QrCode.stop();
        }
    });
</script>

@push('styles')
<style>
    #reader {
        border: 2px dashed #4361ee;
        border-radius: 10px;
        padding: 20px;
        background: #f8f9fa;
    }
    #reader video {
        border-radius: 8px;
    }
    .card {
        border-radius: 20px;
    }
    .card-header {
        border-radius: 20px 20px 0 0 !important;
    }
</style>
@endpush
@endsection