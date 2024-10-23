<?php
// Inisialisasi variabel
$lantai = $tipe = $jumlahHari = $diskon = $totalHarga = $totalDiskon = $totalPembayaran = $totalTransaksi = 0;

// Harga kamar
$hargaKamar = [
    'standard' => 300000,
    'superior' => 400000,
    'deluxe' => 500000
];

// Nilai diskon
$diskonTersedia = [
    'tidak-ada' => 0,
    'member' => 0.10, // Diskon 10%
    'promo-hut' => 100000 // Potongan tetap
];

// Tambahkan variabel untuk pesan error
$error = '';

// Konstanta untuk batas maksimum
define('MAX_LANTAI', 20);
define('MAX_HARI', 30);

// Proses form ketika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $lantai = filter_input(INPUT_POST, 'lantai', FILTER_VALIDATE_INT);
    $jumlahHari = filter_input(INPUT_POST, 'jumlahHari', FILTER_VALIDATE_INT);
    
    // Cek nilai negatif dan validasi
    if ($lantai === false || $lantai < 1) {
        $error = 'Lantai harus berupa angka positif';
    } elseif ($lantai > MAX_LANTAI) {
        $error = 'Lantai tidak boleh lebih dari ' . MAX_LANTAI;
    } elseif ($jumlahHari === false || $jumlahHari < 1) {
        $error = 'Jumlah hari harus berupa angka positif';
    } elseif ($jumlahHari > MAX_HARI) {
        $error = 'Jumlah hari tidak boleh lebih dari ' . MAX_HARI . ' hari';
    } else {
        $tipe = $_POST['tipe'];
        $diskon = $_POST['diskon'];
        
        // Hitung harga dasar
        $hargaDasar = $hargaKamar[$tipe] * $jumlahHari;
        
        // Tambahan biaya lantai
        if ($lantai > 5) {
            $hargaDasar += 50000;
        }
        
        // Simpan total transaksi (harga dasar)
        $totalTransaksi = $hargaDasar;

        // Terapkan diskon
        $totalHarga = $hargaDasar;
        if ($diskon === 'member') {
            $totalDiskon = $hargaDasar * $diskonTersedia['member'];
            $totalHarga -= $totalDiskon; // Kurangi diskon
        } elseif ($diskon === 'promo-hut') {
            $totalDiskon = $diskonTersedia['promo-hut'];
            $totalHarga -= $totalDiskon; // Kurangi diskon
        } else {
            $totalDiskon = 0; // Tidak ada diskon
        }

        // Hitung total pembayaran
        $totalPembayaran = $totalHarga; // Total harga sudah memperhitungkan diskon
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Harga - Hotel ABC</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .footer {
            background-color: #4169E1;
            color: white;
            text-align: center;
            padding: 15px;
            position: relative; /* Ganti fixed dengan relative agar footer tidak menempel di bawah */
            width: 100%;
            
        }
        .form-help {
            color: #4169E1;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="header bg-primary text-white p-3 d-flex justify-content-between" >
        <h1>HOTEL PAVALION </h1>
        <nav class="nav">
            <a class="text-white" href="Home.php">Home</a>
            <a class="text-white ml-3" href="CekHarga.php">Cek Harga</a>
            <a class="text-white ml-3" href="formLogin.php">Logout</a>
        </nav>
    </div>

    <div class="container mt-4">
        <h2>Cek Harga</h2>
        
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label>Lantai:</label>
                <input type="number" name="lantai" class="form-control" value="<?php echo $lantai; ?>" min="1" max="20" required>
                <small class="form-help">Maksimal lantai <?php echo MAX_LANTAI; ?></small>
            </div>

            <div class="form-group">
                <label>Tipe:</label>
                <select name="tipe" class="form-control">
                    <option value="standard" <?php if($tipe == "standard") echo "selected"; ?>>Standard</option>
                    <option value="superior" <?php if($tipe == "superior") echo "selected"; ?>>Superior</option>
                    <option value="deluxe" <?php if($tipe == "deluxe") echo "selected"; ?>>Deluxe</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Hari:</label>
                <input type="number" name="jumlahHari" class="form-control" value="<?php echo $jumlahHari; ?>" min="1" max="30" required>
                <small class="form-help">Maksimal <?php echo MAX_HARI; ?> hari</small>
            </div>

            <div class="form-group">
                <label>Diskon:</label>
                <select name="diskon" class="form-control">
                    <option value="tidak-ada" <?php if($diskon == "tidak-ada") echo "selected"; ?>>Tidak Ada</option>
                    <option value="member" <?php if($diskon == "member") echo "selected"; ?>>Member (10%)</option>
                    <option value="promo-hut" <?php if($diskon == "promo-hut") echo "selected"; ?>>Promo HUT</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">HITUNG</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)): ?>
        <div class="hasil mt-4 p-3 bg-light rounded">
            <h3>Total Transaksi:</h3>
            <p style="font-size: 18px; margin-top: 10px;">
                Rp <?php echo number_format($totalTransaksi, 0, ',', '.'); ?>
            </p>
            <h3>Total Diskon:</h3>
            <p style="font-size: 18px; margin-top: 10px;">
                Rp <?php echo number_format($totalDiskon, 0, ',', '.'); ?>
            </p>
            <h3>Total Pembayaran:</h3>
            <p style="font-size: 18px; margin-top: 10px;">
                Rp <?php echo number_format($totalPembayaran, 0, ',', '.'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 PAVALION Hotel. All Rights Reserved.</p>
        <p>Address: 123 Hotel St, City, Country</p>
        <p>Phone: (123) 456-7890</p>
        <p>
            Follow us: 
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
