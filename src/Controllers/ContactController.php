<?php

namespace App\Controllers;

use App\Config;


class ContactController extends Controller
{

    public function index()
    {
        $footerData = $this->getFooterData();
        $this->render(
            '/contact/index.html.twig',
            [
                'footerData' => $footerData
            ]
        );
    }


    public function envoyerMailAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $nom = htmlspecialchars($_POST['nom']) ?? '';
            $email = $_POST['email'] ?? '';
            $message = htmlspecialchars($_POST['message']) ?? '';

            $to = Config::EMAIL;
            $sujet = 'Nouveau message depuis le formulaire de contact';
            $contenu = "Nom : $nom\n";
            $contenu .= "E-mail : $email\n\n";
            $contenu .= "Message :\n$message";

            $headers = 'From: ' . $email . "\r\n" .
                'Reply-To: ' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            if (mail($to, $sujet, $contenu, $headers)) {
                $_SESSION['success'] = "Votre message a été envoyé avec succès !";
            } else {
                $_SESSION['erreur'] = "Une erreur est survenue lors de l'envoi du message.";
            }

            // Redirection vers la page de confirmation
            $this->redirect('/', 301);
            exit();
        }
    }
}
