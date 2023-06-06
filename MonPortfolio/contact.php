<?php
require_once __DIR__ . '/vendor/autoload.php';
use Mailjet\Client;
use Mailjet\Resources;
define('API_USER', 'b4343eaa3c406054d45999cbbcd518a7');
define('API_LOGIN', 'bfb0b8f0a7884aeec07a3e09139d2ed8');
$mj = new Client(API_USER, API_LOGIN, true, ['version' => 'v3.1']);
// echo $_POST['surname'] . "\n";
// echo $_POST['telephone'] . "\n";
// echo $_POST['email'] . "\n";
// echo $_POST['message'] . "\n";



if (!empty($_POST['surname']) && !empty($_POST['telephone']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $surname = htmlspecialchars($_POST['surname']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    echo "conditionn rempli";
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "test";
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $email,
                        'Name' => $surname,
                    ],
                    'To' => [
                        [
                            'Email' => "daryne.saidi@epitech.eu",
                            'Name' => "Daryne"
                        ]
                    ],
                    'Subject' => "Demande de contanct Portfolio",
                    'TextPart' => "$email, $message",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        if ($response->success()) {
            echo "Email envoyé avec succès !";
        } else {
            echo "Erreur lors de l'envoi de l'email.";
        }
    } else {
        echo "Email non valide";
    }
    header('Location: /#contact');

} else {
    header('Location: /#contact');
    die();
}
