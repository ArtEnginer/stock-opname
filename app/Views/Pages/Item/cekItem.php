<?php $this->extend('Views/Layout/index.php') ?>
<?php $this->section('main') ?>
<div id="interactive" class="viewport"></div>
<div class="container mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cek Data Barang</h4>
        </div>
        <div class="card-body text-center">
            <button class="btn btn-primary btn-sm text-white" id="toggleWebcamBtn">Open Webcam</button>
            <div class="form-group">
                <label for="barcodeInput">Barcode:</label>
                <input type="text" class="form-control" id="barcodeInput">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Hasil Pencarian Barang</h4>
        </div>
        <div class="card-body">
            <div class="result"></div>
        </div>
    </div>
</div>

<!-- Include QuaggaJS library -->
<script src="https://cdn.jsdelivr.net/npm/quagga"></script>

<!-- Include beep sound -->
<audio id="beep" src="<?= base_url() . "/assets/audio/beep-01a.mp3" ?>"></audio>

<script>
    var isWebcamOpen = false;

    // Function to toggle the webcam state
    function toggleWebcam() {
        if (!isWebcamOpen) {
            openWebcam();
            document.getElementById('toggleWebcamBtn').textContent = 'Close Webcam';
        } else {
            closeWebcam();
            document.getElementById('toggleWebcamBtn').textContent = 'Open Webcam';
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
                constraints: {
                    width: 640,
                    height: 480,
                    facingMode: "environment",
                },
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader", "2of5_reader", "code_93_reader"]
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
        });
    }

    // Function to close the webcam
    function closeWebcam() {
        Quagga.stop();
        // Additional cleanup if needed
    }

    // Function to fetch data from the API
    function fetchDataFromAPI(barcode) {
        // Make an AJAX request to the API
        var base_url = '<?= base_url() . 'api/item/cekitem/' ?>';
        var apiEndpoint = base_url + barcode;
        fetch(apiEndpoint)
            .then(response => response.json())
            .then(data => {
                // Update the DOM with the fetched data
                updateResult(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Function to update the DOM with the fetched data
    function updateResult(data) {
        var resultElement = document.querySelector('.result');
        // Customize this part based on your API response structure
        resultElement.innerHTML = '<p>Product Name: ' + data.nama + '</p>' +
            '<p>Price: ' + data.harga_jual + '</p>';
    }

    // Event listener for the "Open/Close Webcam" button
    document.getElementById('toggleWebcamBtn').addEventListener('click', toggleWebcam);
</script>

<?php $this->endSection() ?>