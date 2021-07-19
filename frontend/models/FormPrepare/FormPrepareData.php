<?php


namespace frontend\models\FormPrepare;


class FormPrepareData implements FormPrepareInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepare(): array
    {
        $data = [];
        foreach ($this->data as $name => $value) {
            if (!is_array($value)) {
                $data[] = [
                    'name' => $name,
                    'value' => $value,
                ];
            }
        }

        return $data;
    }

}