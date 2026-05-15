# ChairPal AI / HW Communication Architecture

This document outlines the high-level architecture and rules governing the interaction between the Laravel Backend and the onboard AI/HW Wheelchair Controller.

## 1. Core Principles

### Local Safety Primacy (LSP)
**"All safety-critical and time-sensitive decisions must execute locally on the AI/HW controller without backend dependency."**
The wheelchair must never wait for a server response to avoid an obstacle, stop in an emergency, or maintain balance.

### Asynchronous & Non-blocking Ingestion
The backend communication is designed to be asynchronous. When the wheelchair sends telemetry or events, the backend acknowledges receipt with a `202 Accepted` status. This indicates that the data has been ingested for background processing, ensuring that network latency does not block the wheelchair's local operations.

### High-Level Coordination Only
The backend acts as a **High-Level Coordination Layer**. It manages trip lifecycle, global navigation requests, long-term health tracking, and notifications. It **never** directly controls motors or low-level movement.

## 2. Navigation Modes

-   **Manual**: The user controls movement directly via the mobile app. All requests pass through local AI safety validation.
-   **Assisted**: An authorized assistant sends high-level intervention requests.
-   **Autonomous**: The wheelchair navigates a route independently. This mode is only available when a map or route context exists (mapped environments).

## 3. Data Structures

### Flexible Position Data (`position_data`)
Positioning is stored as an extensible JSON object to support diverse environments:
-   **GPS**: `{ "type": "gps", "lat": 30.0, "lng": 31.0 }`
-   **Indoor**: `{ "type": "indoor", "x": 10.5, "y": 20.2, "floor": 2, "building_id": 5 }`
-   **Map-Relative**: `{ "type": "map", "node_id": "A12", "offset": 0.5 }`

### Decision Context
Every AI decision (recorded in `AIStatusLog`) includes a `decision_context` JSON capturing the state of the world (obstacle distance, battery, sensor states) at the exact moment the decision was made.

## 4. Fail-Safe Behavior

The system is designed to be resilient to connectivity issues:
1.  **Lost Connection**: If the wheelchair loses connection to the backend, it must switch to a safe state (e.g., local stop or manual-only) based on the current navigation mode.
2.  **Degraded Performance**: The `DeviceStatus` monitors connectivity levels (`online`, `degraded_connection`, `offline`) to adjust autonomous behavior.

## 5. Notification & Escalation

Events are mapped to a delivery strategy based on severity:
-   **Info**: Logged and visible in-app.
-   **Warning**: Push notification to the user's mobile device.
-   **Critical**: Persistent alert + immediate escalation to the assistant module/emergency contacts.
