<?php
// Recibir notificación de Khipu
file_put_contents('log_notificaciones.txt', json_encode($_POST, JSON_PRETTY_PRINT), FILE_APPEND);
http_response_code(200);
echo "Notificación recibida.";
?>
