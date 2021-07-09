<?php


namespace common\models\Manager;


use common\models\Code;
use common\models\DAO\QrCodeCrudDAO;
use common\models\DAO\QrCodeQueryDAO;
use yii\db\ActiveQuery;
use yii\db\Exception;

class QrCodeManager
{
    public function findQuery(): ActiveQuery
    {
        $query = new QrCodeQueryDAO();
        return $query->all();
    }

    public function getAll(): array
    {
        $qrCrud = new QrCodeCrudDAO();
        return $qrCrud->all();
    }

    public function getQrCode($id): Code|null
    {
        $qrCrud = new QrCodeCrudDAO();
        return $qrCrud->one($id);
    }

    /**
     * @param $id
     * @param $field
     *
     * @return string
     *
     * @throws Exception
     */
    public function getField($id, $field): string
    {
        $qrCrud = new QrCodeCrudDAO();
        return $qrCrud->field($id, $field);
    }

    /**
     * @param $id
     * @param $params
     */
    public function updateById($id, $params): void
    {
        $qrCrud = new QrCodeCrudDAO();
        $qrCrud->update($id, $params);
    }

    public function deleteById($id): void
    {
        $qrCrud = new QrCodeCrudDAO();
        $qrCrud->delete($id);
    }
}