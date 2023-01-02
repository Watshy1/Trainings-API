<?php

class FormationsModel
{
    public $id;
    public $name;
    public $beginDate;
    public $endDate;
    public $maxParticipants;
    public $price;

    public function __construct($name, $beginDate, $endDate, $maxParticipants, $price)
    {
        $this->name = $name;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->maxParticipants = $maxParticipants;
        $this->price = $price;
    }

    public function create()
    {
        $pdo = new PDO($_ENV['DB_TYPE'] . ':host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';user=' . $_ENV['DB_USER'] . ';password=' . $_ENV['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('INSERT INTO formations (name, begindate, enddate, maxparticipants, price) VALUES (:name, :begindate, :enddate, :maxparticipants, :price)');
        $statement->execute(
            [
                'name' => $this->name,
                'begindate' => $this->beginDate,
                'enddate' => $this->endDate,
                'maxparticipants' => $this->maxParticipants,
                'price' => $this->price
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
