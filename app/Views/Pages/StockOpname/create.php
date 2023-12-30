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
            <h4 class="card-title">Opname Barang</h4>
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

                <!-- form -->
                <div class="col-md-12 col-sm-12">
                    <div class="formOpname"></div>
                </div>

            </div>
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

    function playBeep() {
        var beep = document.getElementById('beep');
        beep.play();
    }

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
            playBeep();
            fetchDataFromAPI(code);
            toggleWebcamModal();
        });
    }

    function closeWebcam() {
        Quagga.stop();
        document.getElementById('interactive').innerHTML = '';
    }

    function fetchDataFromAPI(barcode) {
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

    function updateResult(data) {
        var resultElement = document.querySelector('.formOpname');

        var html = ` 
        <form id="updateForm">
            <input type="hidden" name="id_item" value="${data.id}">
            <div class="form-floating mt-3">
                <input type="text" class="form-control mb-3" id="nama" placeholder="nama barang" value="${data.nama}" readonly>
                <label for="nama">Nama Barang</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control mb-3" id="stok" placeholder="stok barang" value="${data.stok}" readonly>
                <label for="stok">Stok Barang</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control mb-3" id="stok_lapangan" name="stok_lapangan" placeholder="stok lapangan">
                <label for="stok_lapangan">Stok Lapangan</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control mb-3" id="keterangan" name="keterangan" placeholder="keterangan">
                <label for="keterangan">Keterangan</label>
            </div>
            <div class="form-floating">
                <button type="button" class="btn btn-primary text-white float-start" onclick="submitForm()">Submit</button>
            </div>
        </form>
    `;
        resultElement.innerHTML = html;
    }

    function submitForm() {
        var form = document.getElementById('updateForm');
        var formData = new FormData(form);

        console.log('FormData Content:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        var base_url = '<?= base_url() . 'api/so/create' ?>';
        fetch(base_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status == 200) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4caf50",
                        stopOnFocus: true,
                    }).showToast();
                    setTimeout(() => {
                        document.querySelector('.formOpname').innerHTML = '';
                        document.getElementById('barcodeInput').value = '';
                    }, 1000);
                } else {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true,
                    }).showToast();
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }


    function formatCurrency(amount) {
        return parseFloat(amount).toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
        });
    }
    document.getElementById('toggleWebcamBtn').addEventListener('click', toggleWebcamModal);
    document.getElementById('cekBtn').addEventListener('click', function() {
        var barcode = document.getElementById('barcodeInput').value;
        fetchDataFromAPI(barcode);
    });
</script>

<?php $this->endSection() ?>