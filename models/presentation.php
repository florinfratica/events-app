<?php

class Presentation
{
    public static function find($user_id, $event_id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('SELECT * FROM presentations WHERE user_id = ? AND event_id = ? ORDER BY id DESC  LIMIT 1');
        $query->bind_param("ii", $user_id, $event_id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    public static function insert($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('INSERT INTO presentations (user_id, event_id, presentation) VALUES (?, ?, ?)');
        $query->bind_param("iis", $data['user_id'], $data['event_id'], $data['presentation']);
        $query->execute();
        return $query->insert_id;
    }

    public static function update($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('UPDATE presentations SET presentation = ? WHERE id = ?');
        $query->bind_param("si", $data['presentation'], $data['id']);
        $query->execute();
        return true;
    }

}
