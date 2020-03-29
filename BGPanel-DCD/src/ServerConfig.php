<?php

namespace BGPanelDCD;

use BGPanelDCD\BGPanel\Box;
use BGPanelDCD\BGPanel\DCDCallback;

/**
 * Class ServerConfig
 *
 * @package BGPanelDCD
 */
class ServerConfig
{

    /**
     * @param string $remoteIp
     * @return array
     */
    public static function getConfigsByRemoteIp(string $remoteIp): array
    {
        $boxId = Box::getByIp($remoteIp);

        if ($boxId != false) {
            return self::getConfigsByBoxId($boxId);
        }

        return [];
    }

    /**
     * @param int $boxId
     * @return array
     */
    public static function getConfigsByBoxId(int $boxId): array
    {
        $gameservers = Box::findGameserversByBoxId($boxId);
        return ConfigBuilder::buildForGameservers($gameservers);
    }

    /**
     * @param int $boxId
     * @return int
     */
    public static function getConfigCountByBoxId(int $boxId): int
    {
        $count       = 0;
        $gameservers = self::getConfigsByBoxId($boxId);
        foreach ($gameservers as $configs) {
            $count = $count + count($configs);
        }

        return $count;
    }

    /**
     * @param string $remoteIp
     * @param int    $totalAmount
     * @param int    $successAmount
     * @param int    $errorAmount
     */
    public static function processCallback(string $remoteIp, int $totalAmount, int $successAmount, int $errorAmount)
    {
        $boxId = Box::getByIp($remoteIp);

        if ($boxId == false) {
            return;
        }

        $callback = new DCDCallback();
        $callback->setBoxId($boxId);
        $callback->setTotalAmount($totalAmount);
        $callback->setSuccessAmount($successAmount);
        $callback->setErrorAmount($errorAmount);
        $callback->insert();
    }

}
