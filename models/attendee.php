<?php

class Attendee
{
    public static function allWhere($event_id)
    {
        $results = [];
        $db = Db::getInstance();
        $query = $db->prepare('SELECT CONCAT_WS(" ", users.first_name, users.last_name), users.email, users.job_title FROM attendees_to_events LEFT JOIN users ON users.id = attendees_to_events.user_id WHERE attendees_to_events.event_id = ?');
        $query->bind_param("i", $event_id);
        $query->execute();
        $query->bind_result($full_name, $email, $job_title);
        while ($query->fetch()) {
            $results[] = [
                'full_name' => $full_name,
                'email' => $email,
                'job_title' => $job_title,
            ];
        }
        return $results;
    }

    public static function insert($user_id, $event_id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('INSERT INTO attendees_to_events (user_id, event_id) VALUES (?, ?)');
        $query->bind_param("ii", $user_id, $event_id);
        $query->execute();
        return $query->insert_id;
    }

    public static function delete($user_id, $event_id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('DELETE FROM attendees_to_events WHERE user_id = ? AND event_id = ?');
        $query->bind_param("ii", $user_id, $event_id);
        $query->execute();
        return true;
    }

    public static function count()
    {
        $db = Db::getInstance();
        $query = $db->query("SELECT COUNT(*) as count FROM attendees_to_events");
        $result = $query->fetch_array(MYSQLI_ASSOC);
        return $result['count'];
    }

    public static function countWhere($user_id, $event_id)
    {
        $db = Db::getInstance();
        $query = $db->prepare("SELECT COUNT(*) FROM attendees_to_events WHERE user_id = ? AND event_id = ?");
        $query->bind_param("ii", $user_id, $event_id);
        $query->execute();
        $query->bind_result($count);
        $query->fetch();
        $query->close();
        return $count;
    }

    public static function eventCount($event_id)
    {
        $db = Db::getInstance();
        $query = $db->prepare("SELECT COUNT(*) FROM attendees_to_events WHERE event_id = ?");
        $query->bind_param("i", $event_id);
        $query->execute();
        $query->bind_result($count);
        $query->fetch();
        $query->close();
        return $count;
    }
}
