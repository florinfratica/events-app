<?php

class Event
{
    public static function all()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT events.*, CONCAT_WS(" ", u1.first_name, u1.last_name) speaker_1_fullname, CONCAT_WS(" ", u2.first_name, u2.last_name) speaker_2_fullname, CONCAT_WS(" ", u3.first_name, u3.last_name) speaker_3_fullname FROM events
                LEFT JOIN users u1 on u1.id = events.speaker_1
                LEFT JOIN users u2 on u2.id = events.speaker_2
                LEFT JOIN users u3 on u3.id = events.speaker_3
            ORDER BY scheduled_at ASC');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('SELECT events.*, CONCAT_WS(" ", u1.first_name, u1.last_name) speaker_1_fullname, CONCAT_WS(" ", u2.first_name, u2.last_name) speaker_2_fullname, CONCAT_WS(" ", u3.first_name, u3.last_name) speaker_3_fullname, u1.email speaker_1_email, u2.email speaker_2_email, u3.email speaker_3_email, u1.avatar speaker_1_avatar, u2.avatar speaker_2_avatar, u3.avatar speaker_3_avatar, u1.job_title speaker_1_jobtitle, u2.job_title speaker_2_jobtitle, u3.job_title speaker_3_jobtitle FROM events
                LEFT JOIN users u1 on u1.id = events.speaker_1
                LEFT JOIN users u2 on u2.id = events.speaker_2
                LEFT JOIN users u3 on u3.id = events.speaker_3 WHERE events.id = ? LIMIT 1');
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    public static function insert($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('INSERT INTO events (speaker_1, speaker_2, speaker_3, title, theme, image, scheduled_at) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->bind_param("iiissss", $data['speakers'][0], $data['speakers'][1], $data['speakers'][2], $data['title'], $data['theme'], $data['image'], $data['date']);
        for ($i = 0; $i < 3; $i++) {
            $data['speakers'][$i] = intval($data['speakers'][$i]);
        }
        $query->execute();
        return $query->insert_id;
    }

    public static function update($data)
    {
        $db = Db::getInstance();
        for ($i = 0; $i < 3; $i++) {
            $data['speakers'][$i] = intval($data['speakers'][$i]);
        }
        $data['id'] = intval($data['id']);
        $query = $db->prepare('DELETE FROM attendees_to_events WHERE user_id IN (?, ?, ?) AND event_id = ?');
        $query->bind_param("iiii", $data['speakers'][0], $data['speakers'][1], $data['speakers'][2], $data['id']);
        $query->execute();
        $query->close();
        $query2 = $db->prepare('DELETE FROM presentations WHERE user_id NOT IN (?, ?, ?) AND event_id = ?');
        $query2->bind_param("iiii", $data['speakers'][0], $data['speakers'][1], $data['speakers'][2], $data['id']);
        $query2->execute();
        $query2->close();
        $query3 = $db->prepare('UPDATE events SET speaker_1 = ?, speaker_2 = ?, speaker_3 = ?, title = ?, theme = ?, scheduled_at = ? WHERE id = ?');
        $query3->bind_param("iiisssi", $data['speakers'][0], $data['speakers'][1], $data['speakers'][2], $data['title'], $data['theme'], $data['date'], $data['id']);
        $query3->execute();
        return true;
    }

    public static function delete($id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('DELETE FROM events WHERE id = ?');
        $query->bind_param("i", $id);
        $data['id'] = intval($id);
        $query->execute();
        return true;
    }

    public static function count()
    {
        $db = Db::getInstance();
        $query = $db->query("SELECT COUNT(*) as count FROM events");
        $result = $query->fetch_array(MYSQLI_ASSOC);
        return $result['count'];
    }

    public static function soon()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT events.*, CONCAT_WS(" ", u1.first_name, u1.last_name) speaker_1_fullname, CONCAT_WS(" ", u2.first_name, u2.last_name) speaker_2_fullname, CONCAT_WS(" ", u3.first_name, u3.last_name) speaker_3_fullname FROM events
                LEFT JOIN users u1 on u1.id = events.speaker_1
                LEFT JOIN users u2 on u2.id = events.speaker_2
                LEFT JOIN users u3 on u3.id = events.speaker_3
            WHERE scheduled_at > NOW() ORDER BY scheduled_at ASC LIMIT 3');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }

}
