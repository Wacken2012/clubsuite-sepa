<?php
namespace OCA\ClubSuiteSepa\Db;

class PaymentEntity {
    private ?int $id = null;
    private int $runId;
    private string $userId;
    private float $amount;
    private ?string $purpose = null;

    public function __construct(int $runId, string $userId, float $amount) {
        $this->runId = $runId;
        $this->userId = $userId;
        $this->amount = $amount;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getRunId(): int { return $this->runId; }
    public function getUserId(): string { return $this->userId; }
    public function getAmount(): float { return $this->amount; }
    public function setAmount(float $a): void { $this->amount = $a; }
    public function getPurpose(): ?string { return $this->purpose; }
    public function setPurpose(?string $p): void { $this->purpose = $p; }
}
