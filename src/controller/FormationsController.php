<?php

require_once __DIR__ . '/../model/FormationsModel.php';

class FormationsController
{

    public function createFormations($name, $beginDate, $endDate, $maxParticipants, $price)
    {
        $formations = new FormationsModel($name, $beginDate, $endDate, $maxParticipants, $price);
        $formations->create();
    }

    public function getFormations()
    {
        $formations = FormationsModel::findAll();
        return $formations;
    }

    public function getOneFormations($id)
    {
        $formations = FormationsModel::findById($id);
        return $formations;
    }
}
