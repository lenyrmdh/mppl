<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji Pegawai</title>

    <!-- ✅ Library html2canvas & jsPDF -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fb;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .slip-container {
            max-width: 850px;
            margin: auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 120px;
            height: auto;
            margin-bottom: 5px;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #004085;
        }

        .company-address {
            font-size: 12px;
            color: #555;
        }

        .judul {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 30px 0 20px;
            text-transform: uppercase;
            color: #007bff;
        }

        .info-box {
            background: #f0f8ff;
            padding: 20px;
            border-left: 4px solid #007bff;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .info-box p {
            margin: 6px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 40px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #dbeeff;
            text-align: left;
            color: #004085;
        }

        tr:nth-child(even) {
            background-color: #f9fbff;
        }

        .signature-section {
            margin-top: 60px;
            text-align: right;
        }

        .signature-block {
            text-align: center;
            display: inline-block;
            width: 300px;
        }

        .signature-image {
            height: 60px;
            margin: 10px auto;
        }

        .signature-line {
            border-bottom: 1px solid #555;
            height: 2px;
            width: 80%;
            margin: 10px auto 6px;
        }

        .signature-name {
            font-weight: bold;
            font-style: italic;
            color: #333;
        }

        .footer {
            text-align: right;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }

        .btn-save {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-save button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            color: white;
        }

        .btn-png { background-color: #007bff; }
        .btn-pdf { background-color: #dc3545; }
    </style>
</head>
<body>

    <!-- ✅ Tombol Simpan Gambar & PDF -->
    <div class="btn-save">
        <button class="btn-png" onclick="downloadAsImage()">Simpan sebagai Gambar (PNG)</button>
        <button class="btn-pdf" onclick="downloadAsPDF()">Export ke PDF</button>
    </div>

    <!-- ✅ Slip Gaji -->
    <div class="slip-container" id="slip-gaji">

        <div class="header">
            <img src="{{ asset('front/assets/kantor.jpg') }}" alt="Logo Perusahaan">
            <div class="company-name">Pt. DigitalEdu</div>
            <div class="company-address">Jl. Teknologi No.1, Tangerang - Banten, Indonesia</div>
        </div>

        <div class="judul">Slip Gaji Pegawai</div>

        <div class="info-box">
            <p><strong>Nama Pegawai:</strong> {{ $slipGaji->dataPegawai->nama ?? 'Tidak Diketahui' }}</p>
            <p><strong>Periode:</strong> {{ $slipGaji->periode }}</p>
        </div>

        <table>
            <tr>
                <th>Keterangan</th>
                <th>Nilai</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>Rp {{ number_format($slipGaji->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td>Rp {{ number_format($slipGaji->tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td>Rp {{ number_format($slipGaji->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Lembur</td>
                <td>{{ $slipGaji->total_lembur }} jam</td>
            </tr>
            <tr>
                <td>Total Cuti</td>
                <td>{{ $slipGaji->total_cuti }} hari</td>
            </tr>
            <tr>
                <td>Sisa Cuti</td>
                <td>{{ $slipGaji->sisa_cuti }} hari</td>
            </tr>
            <tr>
                <th>Gaji Bersih</th>
                <th>Rp {{ number_format($slipGaji->gaji_bersih, 0, ',', '.') }}</th>
            </tr>
        </table>

        <div class="signature-section">
            <div class="signature-block">
                <p>Tangerang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <img src="{{ asset('front/assets/direktur.jpg') }}" alt="TTD Direktur" class="signature-image">
                <div class="signature-line"></div>
                <div class="signature-name">Adaneley</div>
                <p>Direktur Utama</p>
            </div>
        </div>

        <div class="footer">
            Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>
    </div>

    <!-- ✅ Script Export PNG -->
    <script>
        function downloadAsImage() {
            const element = document.getElementById("slip-gaji");

            html2canvas(element, {
                scale: 3,
                useCORS: true,
                backgroundColor: "#ffffff"
            }).then(canvas => {
                const link = document.createElement("a");
                link.href = canvas.toDataURL("image/png");
                link.download = "slip-gaji-{{ $slipGaji->dataPegawai->nama ?? 'pegawai' }}.png";
                link.click();
            });
        }
    </script>

    <!-- ✅ Script Export PDF -->
    <script>
        async function downloadAsPDF() {
            const { jsPDF } = window.jspdf;
            const element = document.getElementById("slip-gaji");

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                backgroundColor: "#ffffff"
            }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF("p", "mm", "a4");

                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
                pdf.save("slip-gaji-{{ $slipGaji->dataPegawai->nama ?? 'pegawai' }}.pdf");
            });
        }
    </script>

</body>
</html>
