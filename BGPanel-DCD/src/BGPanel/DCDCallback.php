<?php

namespace BGPanelDCD\BGPanel;

/**
 * Class DCDCallback
 *
 * @package BGPanelDCD/BGPanel
 */
class DCDCallback
{
    /**
     * @var int
     */
    private $boxId = 0;

    /**
     * @var int
     */
    private $totalAmount = 0;

    /**
     * @var int
     */
    private $successAmount = 0;

    /**
     * @var int
     */
    private $errorAmount = 0;

    /**
     * @var string
     */
    private $dateTime = '';

    /**
     * @return int
     */
    public function getBoxId(): int
    {
        return $this->boxId;
    }

    /**
     * @param int $boxId
     */
    public function setBoxId(int $boxId)
    {
        $this->boxId = $boxId;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount(int $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return int
     */
    public function getSuccessAmount(): int
    {
        return $this->successAmount;
    }

    /**
     * @param int $successAmount
     */
    public function setSuccessAmount(int $successAmount)
    {
        $this->successAmount = $successAmount;
    }

    /**
     * @return int
     */
    public function getErrorAmount(): int
    {
        return $this->errorAmount;
    }

    /**
     * @param int $errorAmount
     */
    public function setErrorAmount(int $errorAmount)
    {
        $this->errorAmount = $errorAmount;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * @param string $dateTime
     */
    public function setDateTime(string $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * insert this object in DB
     */
    public function insert()
    {
        $db = Db::getDb();
        $db->insert(
            'dcd_callback',
            [
                'boxId'         => $this->getBoxId(),
                'totalAmount'   => $this->getTotalAmount(),
                'successAmount' => $this->getSuccessAmount(),
                'errorAmount'   => $this->getErrorAmount(),
                'dateTime'      => date('Y-m-d H:i:s'),
            ]
        );
    }

    /**
     * @param int $boxId
     * @return array|bool|mixed
     */
    public static function getLastestCallbackForBoxId($boxId)
    {
        $db = Db::getDb();
        return $db->get("dcd_callback", "*", ["boxId" => $boxId, "ORDER" => ["dateTime" => "DESC"]]);
    }
}
