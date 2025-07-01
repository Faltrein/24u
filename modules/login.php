<?php
class Login {
    function get_log_data() {
        return ['user' => 'user', 'pass' => 'user123']; 
    }
}


header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$login = new Login();
$credentials = $login->get_log_data();

if (
    isset($data['username'], $data['password']) &&
    $data['username'] === $credentials['user'] &&
    $data['password'] === $credentials['pass']
) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
