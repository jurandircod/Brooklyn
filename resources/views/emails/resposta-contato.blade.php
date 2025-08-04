<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resposta do Suporte</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #667eea; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { padding: 20px; text-align: center; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Resposta do Suporte</h1>
        </div>
        <div class="content">
            <p>Olá {{ $nome_cliente }},</p>
            <p>{{ $mensagem }}</p>
            <p>Atenciosamente,<br>Equipe de Suporte</p>
        </div>
        <div class="footer">
            <p>Este é um email automático, não responda a esta mensagem.</p>
        </div>
    </div>
</body>
</html>
