<?php

class FormationsModel
{
    public $id;
    public $name;
    public $beginDate;
    public $endDate;
    public $maxParticipants;
    public $price;
    public $participants;

    public function __construct($name, $beginDate, $endDate, $maxParticipants, $price, $participants)
    {
        $this->name = $name;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->maxParticipants = $maxParticipants;
        $this->price = $price;
        $this->participants = $participants;
    }

    public function create()
    {
        $pdo = new PDO($_ENV['DB_TYPE'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';user=' . $_ENV['DB_USER'] . ';password=' . $_ENV['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('INSERT INTO formations (name, beginDate, endDate, maxParticipants, price, participants) VALUES (:name, :beginDate, :endDate, :maxParticipants, :price, :participants)');
        $statement->execute(
            [
                'name' => $this->name,
                'beginDate' => $this->beginDate,
                'endDate' => $this->endDate,
                'maxParticipants' => $this->maxParticipants,
                'price' => $this->price,
                'participants' => $this->participants
            ]
        );
    }

    public static function findAll(): array
    {
        $pdo = new PDO($_ENV['DB_TYPE'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';user=' . $_ENV['DB_USER'] . ';password=' . $_ENV['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('SELECT * FROM formations');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function findById($id): array
    {
        $pdo = new PDO($_ENV['DB_TYPE'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';user=' . $_ENV['DB_USER'] . ';password=' . $_ENV['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('SELECT * FROM formations WHERE id = :id');
        $statement->execute(['id' => $id]);

        return $statement->fetchAll();
    }
}
