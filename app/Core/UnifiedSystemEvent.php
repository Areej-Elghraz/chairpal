<?php

namespace App\Core;

class UnifiedSystemEvent
{
    public string $type;
    public string $source;
    public string $severity;
    public array $payload;
    public int $timestamp_ms;

    public function __construct(string $type, string $source, string $severity, array $payload, int $timestamp_ms)
    {
        $this->type = $type;
        $this->source = $source;
        $this->severity = $severity;
        $this->payload = $payload;
        $this->timestamp_ms = $timestamp_ms;
    }

    public static function make(string $type, string $source, string $severity, array $payload, int $timestamp_ms): self
    {
        return new self($type, $source, $severity, $payload, $timestamp_ms);
    }

    /**
     * Generate a unique hash for this event to prevent duplication.
     */
    public function getEventHash(): string
    {
        $chairId = $this->payload['e_chair_id'] ?? 'unknown';
        return md5("event_{$chairId}_{$this->type}_{$this->timestamp_ms}");
    }
}
