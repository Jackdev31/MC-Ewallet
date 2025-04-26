@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- E-wallet Balance Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My E-wallet</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4">₱{{ number_format(auth()->user()->ewallet->balance ?? 0, 2) }}</h1>
                    <p class="text-muted">Available Balance</p>
                </div>
            </div>

            <!-- Scan QR to Pay Button -->
            <div class="text-center">
                <button id="scanButton" class="btn btn-success btn-lg">
                    <i class="ti ti-scan"></i> Scan QR to Pay
                </button>
            </div>

            <!-- Scanner Modal -->
            <div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="scannerModalLabel">Scan QR Code</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <video id="preview" style="width: 100%; height: auto;"></video>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- Instascan Working Version -->
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
        document.getElementById('scanButton').addEventListener('click', function () {
            var scannerModal = new bootstrap.Modal(document.getElementById('scannerModal'));
            scannerModal.show();

            let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });

            scanner.addListener('scan', function (content) {
                scanner.stop();
                scannerModal.hide();

                try {
                    let qrData = JSON.parse(content);

                    if (qrData.amount) {
                        if (confirm(`Confirm Payment of ₱${qrData.amount.toFixed(2)}?`)) {
                            window.location.href = `/e-wallet-pay/confirm?amount=${qrData.amount}&reference=${qrData.reference}`;
                        }
                    } else {
                        alert('Invalid QR code scanned.');
                    }
                } catch (e) {
                    alert('Invalid QR code format.');
                }
            });

            // Try to get available cameras
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
                alert('Error accessing camera.');
            });
        });
    </script>
@endpush
