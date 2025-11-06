<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credenciales de acceso</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; background: white; padding: 20px; border-radius: 10px;">
        <h2 style="color: #cc0000;">Bienvenido(a) a la Facultad de Ingeniería - UFPSO</h2>
        <p>Tu cuenta institucional ha sido creada exitosamente. Estas son tus credenciales:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td><strong>Correo institucional:</strong></td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td><strong>Contraseña:</strong></td>
                <td>{{ $password }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Por favor inicia sesión en el sistema y cambia tu contraseña al ingresar por primera vez.
        </p>

        <p>Atentamente,<br><strong>Facultad de Ingeniería UFPSO</strong></p>
    </div>
</body>
</html>
