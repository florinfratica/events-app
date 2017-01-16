<?php

class EventsController
{
    public function index()
    {
        if (!isset($_SESSION['auth_id'])) {
            redirect();
        }
        $user_id = $_SESSION['auth_id'];
        $events = Event::all();
        foreach ($events as $key => $event) {
            if (!in_array($user_id, [$event['speaker_1'], $event['speaker_2'], $event['speaker_3']]) && Attendee::countWhere($user_id, $event['id']) == 0) {
                unset($events[$key]);
            }
        }
        if (isset($_GET['delete_id'])) {
            $delete_event = Event::find($_GET['delete_id']);
            if (!$delete_event) {
                redirect('?page=events&action=index');
            }
        } else if (isset($_GET['confirm_delete'])) {
            $delete_event = Event::find($_GET['confirm_delete']);
            if (!$delete_event) {
                redirect('?page=events&action=index');
            }
            Attendee::delete($user_id, $_GET['confirm_delete']);
            $_SESSION['flash'] = ['class' => 'success', 'message' => 'Participarea la eveniment a fost anulată.'];
            redirect('?page=events&action=index');
        }
        require_once 'views/events/index.php';
    }

    public function show()
    {
        require_once 'models/attendee.php';
        require_once 'models/presentation.php';
        if (!isset($_GET['id'])) {
            redirect();
        }
        $event = Event::find($_GET['id']);
        if (!$event) {
            redirect();
        }
        for ($i = 1; $i <= 3; $i++) {
            $event['speaker_' . $i . '_presentation'] = Presentation::find($event['speaker_' . $i], $event['id'])['presentation'];
        }
        if (!$event) {
            call('pages', 'error');
        }
        require_once 'views/events/show.php';
    }

    public function admin()
    {
        // Allow access only for admins
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y') {
            redirect();
        }
        $events = Event::all();
        if (isset($_GET['delete_id'])) {
            $delete_event = Event::find($_GET['delete_id']);
            if (!$delete_event) {
                redirect('?page=events&action=admin');
            }
        } else if (isset($_GET['confirm_delete'])) {
            $delete_event = Event::find($_GET['confirm_delete']);
            if (!$delete_event) {
                redirect('?page=events&action=admin');
            }
            Event::delete($_GET['confirm_delete']);
            $_SESSION['flash'] = ['class' => 'success', 'message' => 'Evenimentul a fost șters din aplicație.'];
            redirect('?page=events&action=admin');
        }
        require_once 'views/events/admin.php';
    }

    public function create()
    {
        // Allow access only for admins
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y') {
            redirect();
        }
        $speakers_options = User::speakers();
        $fields = ['title', 'theme', 'date', 'speakers', 'image'];
        $old = $errors = array_fill_keys($fields, null);
        $old['speakers'] = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    if ($field == 'speakers') {
                        $old[$field] = $value;
                    } else {
                        $old[$field] = trim($value);
                    }
                }
            }
            $old['image'] = $_FILES['image']['tmp_name'];
            $errors['title'] = field_is_empty($old['title']) ?: $errors['title'];
            $errors['theme'] = field_is_empty($old['theme']) ?: $errors['theme'];
            $errors['speakers'] = field_choises($old['speakers'], 3) ?: $errors['speakers'];
            $errors['date'] = field_date_has_passed($old['date']) ?: $errors['date'];
            $errors['date'] = field_is_empty($old['date']) ?: $errors['date'];
            $errors['image'] = image_size($old['image'], 800, 500) ?: $errors['image'];
            $errors['image'] = file_not_image($old['image']) ?: $errors['image'];
            $errors['image'] = no_file_selected($old['image']) ?: $errors['image'];
            if (form_is_valid($errors)) {
                $temp = explode(".", $_FILES["image"]["name"]);
                $new_file_name = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($old['image'], ROOT . "/uploads/$new_file_name");
                unset($old['image']);
                $old['image'] = $new_file_name;
                $scheduled_at = DateTime::createFromFormat("Y-m-d\TH:i", $old['date']);
                $old['date'] = $scheduled_at->format('Y-m-d H:i:s');
                Event::insert($old);
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Evenimentul a fost creat cu succes.'];
                redirect('?page=events&action=admin');
            }
        }
        require_once 'views/events/create.php';
    }

    public function update()
    {
        // Allow access only for admins and require id
        if (!isset($_SESSION['auth_id']) || $_SESSION['auth']['admin'] != 'Y' || !isset($_GET['id'])) {
            redirect();
        }
        $speakers_options = User::speakers();
        $fields = ['title', 'theme', 'date', 'speakers', 'image'];
        $errors = array_fill_keys($fields, null);
        $old = Event::find($_GET['id']);
        if (!$old) {
            redirect('?page=events&action=admin');
        }
        $old['speakers'] = [$old['speaker_1'], $old['speaker_2'], $old['speaker_3']];
        $old['date'] = date('Y-m-d\TH:i', strtotime($old['scheduled_at']));
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $field => $value) {
                if (array_key_exists($field, $old)) {
                    if ($field == 'speakers') {
                        $old[$field] = $value;
                    } else {
                        $old[$field] = trim($value);
                    }
                }
            }
            $errors['title'] = field_is_empty($old['title']) ?: $errors['title'];
            $errors['theme'] = field_is_empty($old['theme']) ?: $errors['theme'];
            $errors['speakers'] = field_choises($old['speakers'], 3) ?: $errors['speakers'];
            $errors['date'] = field_date_has_passed($old['date']) ?: $errors['date'];
            $errors['date'] = field_is_empty($old['date']) ?: $errors['date'];
            if (form_is_valid($errors)) {
                $scheduled_at = DateTime::createFromFormat("Y-m-d\TH:i", $old['date']);
                $old['date'] = $scheduled_at->format('Y-m-d H:i:s');
                Event::update($old);
                $_SESSION['flash'] = ['class' => 'success', 'message' => 'Evenimentul a fost editat cu succes.'];
                redirect('?page=events&action=admin');
            }
        }
        require_once 'views/events/update.php';
    }
}
