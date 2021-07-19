<?php


namespace frontend\models\FormPrepare;


class FormPrepare implements FormPrepareInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepare(): array
    {
        $prepareData = new FormPrepareData($this->data);
        $prepareDataWithParams = new FormPrepareDataWithParams($this->data);
        return array_merge($prepareData->prepare(), $prepareDataWithParams->prepare());
    }
}