<?php


namespace frontend\models\FormPrepare;


class FormPrepareDataWithParams implements FormPrepareInterface
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
            if (is_array($value) && 'params' === $name){
                $params = '';
                foreach ($value as $key => $v) {
                    $params .=  '"'.$key.'":"'.$v.'", ';
                }
                $data[] = [
                    'name' => 'params',
                    'value' => mb_substr(trim($params), 0, -1),
                ];
            }
        }

        return $data;
    }

}