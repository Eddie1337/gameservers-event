<?php

namespace BGPanelDCD\BGPanel;

/**
 * Class Box
 *
 * @package BGPanelDCD/BGPanel
 */
class Box
{
    /**
     * @param string $ip
     * @return int
     */
    public static function getByIp(string $ip)
    {
        $db = Db::getDb();
        return $db->get("boxIp", "boxid", ["ip" => $ip]);
    }

    /**
     * @param int $boxId
     * @return array|bool
     */
    public static function findGameserversByBoxId(int $boxId)
    {
        $db = Db::getDb();
        return $db->select("server", "*", ["boxid" => $boxId]);
    }

    /**
     * @return array|bool
     */
    public static function getAll()
    {
        $db = Db::getDb();
        return $db->select("box", ['boxid', 'name', 'ip', 'login', 'password', 'sshport', 'notes']);
    }
}
