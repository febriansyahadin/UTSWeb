<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC PAVALION</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #4169E1;
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            color: white;
            text-decoration: none;
        }

        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .slider {
            width: 100%;
            height: 700px; 
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid #ddd;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%; 
            object-fit: cover; 
        }

        .hotel-profile {
            margin-bottom: 30px;
        }

        .hotel-profile h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .hotel-profile p {
            line-height: 1.6;
            color: #666;
        }

        .footer {
            background-color: #4169E1;
            color: white;
            text-align: center;
            padding: 15px;
            position: relative; /* Ganti fixed dengan relative agar footer tidak menempel di bawah */
            width: 100%;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HOTEL PAVALION</h1>
        <nav class="nav">
            <a href="Home.php">Home</a>
            <a href="CekHarga.php">Cek Harga</a> 
            <a href="Login.php">Logout</a>
        </nav>
    </div>

    <div class="content">
        <div class="slider">
            <div class="slide active">
                <img src="https://cdn.lifestyleasia.com/wp-content/uploads/2019/02/04113012/batch_Hotel_Facade_HR0001.jpg" alt="Hotel Image 1">
            </div>
            <div class="slide">
                <img src="http://upload.wikimedia.org/wikipedia/commons/8/83/Imperial_Hotel_Osaka_regular_floor_standard_twin_room_20120630-001.jpg" alt="Hotel Image 2">
            </div>
            <div class="slide">
                <img src="https://cdn.lifestyleasia.com/wp-content/uploads/2019/02/04113012/batch_Hotel_Facade_HR0001.jpg" alt="Hotel Image 3">
            </div>
        </div>

        <div class="hotel-profile">
            <h2>Hotel Profile</h2>
            <p>Hotel Pavilion Kuala Lumpur adalah hotel mewah yang berlokasi strategis di jantung kota Kuala Lumpur, Malaysia. Terletak dekat dengan pusat perbelanjaan populer, Pavilion Kuala Lumpur, hotel ini menawarkan akses mudah ke berbagai atraksi kota seperti Menara Kembar Petronas, KLCC Park, dan area perbelanjaan Bukit Bintang.

            Hotel ini memiliki fasilitas modern dan lengkap, termasuk kamar yang elegan dan luas dengan pemandangan kota yang menakjubkan, kolam renang outdoor, pusat kebugaran, spa, dan beberapa pilihan restoran yang menyajikan masakan internasional maupun lokal. Setiap kamar dirancang dengan gaya kontemporer yang mewah, dilengkapi dengan teknologi terkini seperti Wi-Fi berkecepatan tinggi, TV layar datar, dan fasilitas kamar mandi premium.

            Hotel Pavilion Kuala Lumpur juga menyediakan fasilitas bisnis seperti ruang pertemuan dan ballroom yang cocok untuk acara bisnis maupun pernikahan. Lokasinya yang strategis dan fasilitas kelas atas membuat hotel ini menjadi pilihan ideal bagi wisatawan yang ingin menikmati pengalaman mewah dan kenyamanan selama berada di Kuala Lumpur.</p>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 PAVALION hotel. All Rights Reserved.</p>
        <p>Address: 123 Hotel St, City, Country</p>
        <p>Phone: (123) 456-7890</p>
        <p>
            Follow us: 
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
        </p>
    </div>

    <script>
        $(document).ready(function() {
            let currentSlide = 0;
            const slides = $('.slide');
            
            function nextSlide() {
                slides.eq(currentSlide).removeClass('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides.eq(currentSlide).addClass('active');
            }

            // Change slide every 3 seconds
            setInterval(nextSlide, 3000);
        });
    </script>
</body>
</html>
