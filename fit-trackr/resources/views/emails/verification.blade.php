<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #555555;
        }
        .code-container {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
        .code {
            font-size: 20px;
            font-weight: bold;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>FitTrackr</h1>
        <p>Hola,</p>
        <p>Has olvidado tu contraseña, no te preocupes, para continuar el proceso de actualización por favor utiliza el siguiente código de verificación:</p>
        <div class="code-container">
            <p class="code">{{ $code }}</p>
        </div>
        <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
        <p>Saludos,</p>
        <p>El equipo de FitTrackr</p>
    </div>
</body>
</html>
