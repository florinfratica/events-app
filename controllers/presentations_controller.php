<?php

class PresentationsController
{
    public function update()
    {
        // Allow access only for users
        if (!isset($_SESSION['auth_id'])) {
            redirect();
        }
        $user_id = $_SESSION['auth_id'];
        $event_id = $_GET['id'];
        $event = Event::find($event_id);
        if (!in_array($user_id, [$event['speaker_1'], $event['speaker_2'], $event['speaker_3']])) {
            redirect();
        }
        $fields = ['presentation'];
        $errors = array_fill_keys($fields, null);
        $old = Presentation::find($user_id, $event_id);
        $action = 'update';
        if (!$old) {
            $action = 'insert';
            $old = [
                'user_id' => $user_id,
                'event_id' => $event_id,
                'presentation' => '',
            ];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    $old[$field] = trim($value);
                }
            }
            if (form_is_valid($errors)) {
                if ($action == 'update') {
                    Presentation::update($old);
                } else {
                    Presentation::insert($old);
                }
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Prezentarea pentru eveniment a fost editată cu succes.'];
                redirect('?page=presentations&action=update&id=' . $event_id);
            }
        }
        require_once 'views/presentations/update.php';
    }
}
