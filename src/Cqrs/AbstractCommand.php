<?php
namespace App\Cqrs;

class AbstractCommand
{
    protected string $sessionId;

    public function __construct(string $sessionId) {
        $this->sessionId = $sessionId;
    }
    public function getSessionId() {
        return $this->sessionId;
    }
}
