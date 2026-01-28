<?php
namespace OCA\ClubSuiteSepa\Db;

use DateTime;

class PaymentRunEntity {
    private ?int $id = null;
    private DateTime $date;
    private ?string $description = null;

    public function __construct(DateTime $date) {
        $this->date = $date;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getDate(): DateTime { return $this->date; }
    public function setDate(DateTime $d): void { $this->date = $d; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $d): void { $this->description = $d; }
}
