<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<style>
    #interactive.viewport.active canvas.drawingBuffer {
        display: block;
    }

    #interactive.viewport.active video {
        display: none;
    }

    #interactive.viewport.active video+canvas {
        display: inline;
    }

    #interactive.viewport video,
    #interactive.viewport canvas.drawingBuffer {
        max-width: 100%;
        height: auto;
    }

    #interactive canvas.drawingBuffer {
        position: absolute;
        left: 0;
        top: 0;
    }

    #interactive.viewport {
        position: relative;
    }
</style>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cek Data Barang</h4>
        </div>
        <div class="card-body text-center">
            <div class="row mt-3">
                <div class="col-md-8 col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="barcodeInput" placeholder="Barcode">
                    </div>
                </div>
                <div class="col-md-4 col-sm-2 mt-2">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary btn-sm text-white" id="toggleWebcamBtn">
                            <i class="fas fa-camera"></i>
                        </button>
                        <button class="btn btn-success btn-sm text-white" id="cekBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Hasil Pencarian Barang</h4>
        </div>
        <div class="card-body">
            <div class="result"></div>
        </div>
    </div>
</div>

<div class="modal" id="webcamModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="interactive" class="viewport"></div>
            </div>
        </div>
    </div>
</div>
<!-- Include QuaggaJS library -->
<script src="https://cdn.jsdelivr.net/npm/quagga"></script>

<!-- Include beep sound -->
<audio id="beep" src="<?= base_url() . "/assets/audio/beep-01a.mp3" ?>"></audio>

<script>
    var isWebcamOpen = false;

    // Function to toggle the webcam modal
    function toggleWebcamModal() {
        if (!isWebcamOpen) {
            $('#webcamModal').modal('show');
            openWebcam();
        } else {
            closeWebcam();
            $('#webcamModal').modal('hide');
        }
        isWebcamOpen = !isWebcamOpen;
    }

    // Function to play the beep sound
    function playBeep() {
        var beep = document.getElementById('beep');
        beep.play();
    }

    // Function to open the webcam
    function openWebcam() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#interactive'),
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader"]
            },
        }, function(err) {
            if (err) {
                console.error(err);
                return;
            }
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;
            document.getElementById('barcodeInput').value = code;

            // Play beep sound when barcode is detected
            playBeep();

            // Fetch data from the API based on the scanned barcode
            fetchDataFromAPI(code);

            // Close the webcam modal after successful detection
            toggleWebcamModal();
        });
    }

    // Function to close the webcam
    function closeWebcam() {
        Quagga.stop();

        // Clear the content of the interactive div
        document.getElementById('interactive').innerHTML = '';
    }

    // Function to fetch data from the API
    function fetchDataFromAPI(barcode) {
        // Make an AJAX request to the API
        var base_url = '<?= base_url() . 'api/item/cekitem/' ?>';
        var apiEndpoint = base_url + barcode;
        fetch(apiEndpoint)
            .then(response => response.json())
            .then(data => {
                data = data.data
                updateResult(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Function to update the DOM with the fetched data
    function updateResult(data) {
        var resultElement = document.querySelector('.result');

        // Check if data is available
        if (data) {
            // Create a table to display product information
            var tableTemplate = `
            <table class="table">
            <tbody>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <td>=</td>
                        <td>${data.nama}</td>
                    </tr>
                    <tr>
                        <th scope="col">Satuan</th>
                        <td>=</td>
                        <td>${data.satuan}</td>
                    </tr>
                    <tr>
                        <th scope="col">Harga Beli</th>
                        <td>=</td>
                        <td>${data.harga_beli}</td>
                    </tr>
                    <tr>
                        <th scope="col">Harga Jual</th>
                        <td>=</td>
                        <td>${data.harga_jual}</td>
                    </tr>
                    <tr>
                        <th scope="col">Harga Jual Grosir</th>
                        <td>=</td>
                        <td>${data.harga_jual_grosir}</td>
                    </tr>
                    <tr>
                        <th scope="col">Stok</th>
                        <td>=</td>
                        <td>${data.stok}</td>
                    </tr>
                    <tr>
                        <th scope="col">Last Updated</th>
                        <td>=</td>
                        <td>${data.updated_at} <span class="badge bg-danger">Minta tanggal paling update</span></td>
                    </tr>
                
                
                </tbody>
            </table>
        `;

            // Display the table template in the result element
            resultElement.innerHTML = tableTemplate;
        } else {
            // Display a message if no data is available
            resultElement.innerHTML = '<p>No information available for the provided barcode.</p>';
        }
    }

    // Function to format currency (replace with your own formatting logic)
    function formatCurrency(amount) {
        // Add your currency formatting logic here
        // For example, you can use toLocaleString()
        return parseFloat(amount).toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
        });
    }

    // Event listener for the "Open/Close Webcam" button
    document.getElementById('toggleWebcamBtn').addEventListener('click', toggleWebcamModal);

    // Event listener for the "Cek" button
    document.getElementById('cekBtn').addEventListener('click', function() {
        var barcode = document.getElementById('barcodeInput').value;
        fetchDataFromAPI(barcode);
    });
</script>

<?php $this->endSection() ?>