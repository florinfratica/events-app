<?php

class Statistics
{
    public static function insert_or_update($page)
    {
        $db = Db::getInstance();
        $query = $db->prepare("SELECT COUNT(*) FROM statistics WHERE page = ?");
        $query->bind_param("s", $page);
        $query->execute();
        $query->bind_result($count);
        $query->fetch();
        $query->close();
        if ($count > 0) {
            $query2 = $db->prepare('UPDATE statistics SET views = views + 1 WHERE page = ?');
            $query2->bind_param("s", $page);
            $query2->execute();
            $query2->close();
        } else {
            $query3 = $db->prepare('INSERT INTO statistics (page) VALUES (?)');
            $query3->bind_param("s", $page);
            $query3->execute();
            $query3->close();
        }
        return true;
    }

    public static function top_pages()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT * FROM statistics ORDER BY views DESC LIMIT 10');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }

    public static function top_events()
    {
        $db = Db::getInstance();
        $query = $db->query('SELECT statistics.*, SUBSTRING(statistics.page, 30) event_id FROM statistics WHERE page LIKE "/?page=events&action=show&id=%" ORDER BY views DESC LIMIT 10');
        $results = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();
        return $results;
    }
}
