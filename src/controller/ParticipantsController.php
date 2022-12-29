<?php

require_once __DIR__ . '/../model/ParticipantsModel.php';

class ParticipantsController
{

    public function createParticipants($firstname, $lastname, $company)
    {
        $participants = new ParticipantsModel($firstname, $lastname, $company);
        $participants->create();
    }

    public function getParticipants()
    {
        $participants = ParticipantsModel::findAll();
        return $participants;
    }

    public function getOneParticipants($id)
    {
        $participants = ParticipantsModel::findById($id);
        return $participants;
    }
}
