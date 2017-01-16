<?php

class User
{
    public static function all()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT * FROM users');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }

    public static function speakers()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT * FROM users WHERE speaker = "Y"');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $query = $db->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    public static function insert($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('INSERT INTO users (username, password, email, first_name, last_name) VALUES (?, ?, ?, ?, ?)');
        $query->bind_param("sssss", $data['username'], $data['password'], $data['email'], $data['first_name'], $data['last_name']);
        $data['password'] = md5($data['password']);
        $query->execute();
        return $query->insert_id;
    }

    public static function update_roles($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('UPDATE users SET admin = ?, speaker = ? WHERE id = ?');
        $query->bind_param("ssi", $data['admin'], $data['speaker'], $data['id']);
        $data['id'] = intval($data['id']);
        $query->execute();
        return true;
    }

    public static function update_profile($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('UPDATE users SET avatar = ?, job_title = ? WHERE id = ?');
        $query->bind_param("ssi", $data['avatar'], $data['job_title'], $data['id']);
        $data['id'] = intval($data['id']);
        $query->execute();
        return true;
    }

    public static function count()
    {
        $db = Db::getInstance();
        $query = $db->query("SELECT COUNT(*) as count FROM users");
        $result = $query->fetch_array(MYSQLI_ASSOC);
        return $result['count'];
    }

    public static function countWhere($field, $value)
    {
        $db = Db::getInstance();
        $query = $db->prepare("SELECT COUNT(*) FROM users WHERE $field = ?");
        $query->bind_param("s", $value);
        $query->execute();
        $query->bind_result($count);
        $query->fetch();
        $query->close();
        return $count;
    }

    public static function authenticate($data)
    {
        $db = Db::getInstance();
        $query = $db->prepare('SELECT id FROM users WHERE username = ? AND password = ? LIMIT 1');
        $query->bind_param("ss", $data['username'], $data['password']);
        $data['password'] = md5($data['password']);
        $query->execute();
        $query->bind_result($id);
        $query->fetch();
        $query->close();
        return $id;
    }
}
