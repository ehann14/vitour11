<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMK Negeri 11 Bandung - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298, #1a2a4a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .home-container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .home-logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(30, 60, 114, 0.9), rgba(42, 82, 152, 0.95));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 3px solid rgba(0, 201, 177, 0.3);
        }

        .home-logo i {
            font-size: 3rem;
            color: #00c9b1;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            background: linear-gradient(to right, #ffffff, #00c9b1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-lihat-sekolah {
            display: inline-block;
            padding: 16px 48px;
            background: linear-gradient(135deg, #00c9b1, #00a896);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 10px 30px rgba(0, 201, 177, 0.4);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-lihat-sekolah:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 201, 177, 0.6);
            background: linear-gradient(135deg, #00a896, #008a7c);
        }

        .btn-lihat-sekolah:active {
            transform: translateY(1px);
        }

        .footer {
            margin-top: 40px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <div class="home-logo">
            <i class="fas fa-graduation-cap"></i>
        </div>
        
        <h1>SMK NEGERI 11 BANDUNG</h1>
        
        <a href="#" class="btn-lihat-sekolah">Lihat Sekolah</a>

        <div class="footer">
            <p>© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>