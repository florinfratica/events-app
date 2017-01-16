<?php

require 'libraries/twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class PagesController
{
    public function home()
    {
        require_once 'models/event.php';
        require_once 'models/attendee.php';
        $next = Event::soon();
        if (isset($_SESSION['auth_id'])) {
            require_once 'views/pages/dashboard.php';
        } else {
            require_once 'views/pages/home.php';
        }
    }

    public function tweets()
    {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
        $query = array(
            "q" => "#ppc",
            "result_type" => "recent",
            "count" => 10,
            "lang" => "en",
        );
        $results = $connection->get('search/tweets', $query);
        $tweets = $results->statuses;
        require_once 'views/pages/tweets.php';
    }

    public function stats()
    {
        require_once 'models/attendee.php';
        require_once 'models/user.php';
        require_once 'models/event.php';
        // Allow access only for admins
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y') {
            redirect();
        }
        $pages = Statistics::top_pages();
        $events = Statistics::top_events();
        foreach ($events as $key => $event) {
            $events[$key]['event_title'] = Event::find($event['event_id'])['title'];
        }
        require_once 'views/pages/stats.php';
    }

    public function contact()
    {
        require_once 'libraries/PHPMailer/PHPMailerAutoload.php';
        require_once 'models/user.php';
        if (!isset($_SESSION['auth_id'])) {
            redirect();
        }
        $auth_id = $_SESSION['auth_id'];
        $fields = ['message'];
        $errors = $old = array_fill_keys($fields, null);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            $errors['message'] = field_is_empty($old['message']) ?: $errors['message'];
            if (form_is_valid($errors)) {
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Debugoutput = 'html';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = EMAIL_ACCOUNT;
                $mail->Password = EMAIL_PASSWORD;
                $mail->CharSet = 'UTF-8';
                $user = User::find($auth_id);
                $mail->setFrom($user['email'], $user['first_name'] . ' ' . $user['last_name']);
                $mail->addReplyTo($user['email'], $user['first_name'] . ' ' . $user['last_name']);
                $admin = User::find(1);
                $mail->addAddress($admin['email'], $admin['first_name'] . ' ' . $admin['last_name']);
                $mail->Subject = '[Events App] Formularul de contact';
                $mail->msgHTML(nl2br($old['message']));
                if (!$mail->send()) {
                    echo "Eroare: " . $mail->ErrorInfo;
                } else {
                    $_SESSION['flash'] = ['class' => 'success', 'message' => 'Mesajul a fost trimis către administratorul aplicației. Vei fi contactat pe adresa de email în curând.'];
                    redirect();
                }
            }
        }
        require_once 'views/pages/contact.php';
    }

    public function error()
    {
        require_once 'views/pages/error.php';
    }
}
