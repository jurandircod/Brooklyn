<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Brooklyn Skate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        .skateboard {
            width: 300px;
            height: 80px;
            background: linear-gradient(45deg, #994D24, #B8652F);
            border-radius: 40px;
            position: relative;
            margin-bottom: 30px;
            transform: rotate(-15deg);
            box-shadow: 0 10px 30px rgba(153, 77, 36, 0.3);
            animation: skateboard-float 3s ease-in-out infinite;
        }

        .skateboard::before,
        .skateboard::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #333;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .skateboard::before {
            left: -10px;
        }

        .skateboard::after {
            right: -10px;
        }

        .logo {
            font-size: 4rem;
            font-weight: bold;
            color: #994D24;
            text-shadow: 3px 3px 0px #000;
            margin-bottom: 20px;
            letter-spacing: 3px;
            text-transform: uppercase;
            animation: logo-glow 2s ease-in-out infinite alternate;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 20px rgba(153, 77, 36, 0.8);
            margin-bottom: 20px;
            animation: error-shake 4s ease-in-out infinite;
        }

        .message {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 30px;
            max-width: 600px;
            line-height: 1.6;
            color: #ccc;
        }

        .btn-home {
            background: linear-gradient(45deg, #994D24, #B8652F);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(153, 77, 36, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-home::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-home:hover::before {
            left: 100%;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(153, 77, 36, 0.6);
        }

        .wheels {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .wheel {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 4px solid #994D24;
            border-radius: 50%;
            opacity: 0.1;
            animation: wheel-roll 8s linear infinite;
        }

        .wheel:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .wheel:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: -2s;
        }

        .wheel:nth-child(3) {
            bottom: 15%;
            left: 8%;
            animation-delay: -4s;
        }

        .wheel:nth-child(4) {
            bottom: 30%;
            right: 5%;
            animation-delay: -6s;
        }

        .graffiti {
            position: absolute;
            font-size: 1.2rem;
            color: #994D24;
            opacity: 0.3;
            font-weight: bold;
            transform: rotate(-20deg);
            z-index: 5;
        }

        .graffiti:nth-child(1) {
            top: 10%;
            left: 10%;
            content: "SKATE";
        }

        .graffiti:nth-child(2) {
            bottom: 10%;
            right: 10%;
            transform: rotate(15deg);
        }

        @keyframes skateboard-float {
            0%, 100% {
                transform: rotate(-15deg) translateY(0px);
            }
            50% {
                transform: rotate(-15deg) translateY(-10px);
            }
        }

        @keyframes logo-glow {
            0% {
                text-shadow: 3px 3px 0px #000, 0 0 10px rgba(153, 77, 36, 0.5);
            }
            100% {
                text-shadow: 3px 3px 0px #000, 0 0 20px rgba(153, 77, 36, 0.8);
            }
        }

        @keyframes error-shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-2px);
            }
            75% {
                transform: translateX(2px);
            }
        }

        @keyframes wheel-roll {
            0% {
                transform: rotate(0deg);
                opacity: 0.1;
            }
            50% {
                opacity: 0.3;
            }
            100% {
                transform: rotate(360deg);
                opacity: 0.1;
            }
        }

        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }
            
            .error-code {
                font-size: 5rem;
            }
            
            .message {
                font-size: 1.2rem;
                padding: 0 20px;
            }
            
            .skateboard {
                width: 200px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="wheels">
        <div class="wheel"></div>
        <div class="wheel"></div>
        <div class="wheel"></div>
        <div class="wheel"></div>
    </div>

    <div class="graffiti">RIDE</div>
    <div class="graffiti">STREET</div>

    <div class="container">
        <div class="skateboard"></div>
        
        <div class="logo">BROOKLYN</div>
        
        <div class="error-code">404</div>
        
        <div class="message">
            Ops! Parece que você tentou uma trick muito avançada...<br>
            Esta página saiu de cena, mas temos muito mais para você explorar!
        </div>
        
        <a href="/" class="btn-home">Voltar para a Loja</a>
    </div>
</body>
</html>