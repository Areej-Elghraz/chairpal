# ChairPal API Reference: AI / HW Communication Layer

This document provides a detailed reference for all endpoints related to the wheelchair hardware and AI coordination.

## Intelligent Backbone Architecture

ChairPal uses an advanced **Event-Driven Intelligence** architecture:
1. **Event Normalization**: All incoming data (health, emergency, hardware) is normalized into a `UnifiedSystemEvent`.
2. **Deterministic Decision Engine**: A stateless `SystemPolicyEngine` decides on the best course of action (escalation, notification, trip pause).
3. **Guarded State Machine**: All trip state transitions are validated by a `TripStateMachine` with strict safety guards (e.g., blocking resume if a device is offline).
4. **Side-effect Isolation**: Decisions are separated from execution, ensuring the system remains predictable and auditable.
5. **Event Deduplication**: An atomic deduplication layer ensures that each event (identified by its unique hash) is processed exactly once, protecting against hardware retries or network duplication.

---

## 1. Trip Management

### Initiate a New Trip
`POST /api/trips`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The unique ID of the wheelchair. |
| `start_location` | JSON | Yes | Extensible object. E.g., `{"type": "gps", "lat": 30, "lng": 31}`. |
| `end_location` | JSON | Yes | Extensible object. E.g., `{"type": "indoor", "x": 10, "y": 5, "floor": 2}`. |
| `navigation_mode` | String | No | Options: `manual` (default), `autonomous`, `assisted`. |
| `metadata` | JSON | No | Additional trip context like reason or user notes. |

---

### Add Trip Update
`POST /api/trips/{trip}/updates`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `update_type` | String | Yes | The nature of the update (e.g., `waypoint_reached`, `reroute`). |
| `source` | String | Yes | Who initiated the update. Options: `user`, `ai`, `assistant`, `system`. |
| `update_data` | JSON | No | Contextual details about the update. |
| `timestamp_ms` | BigInt | Yes | 13-digit Unix timestamp for global timeline synchronization. |

---

## 2. AI / HW Ingestion (Asynchronous)

### Wheelchair Telemetry
`POST /api/ai-hw/telemetry`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `position_data` | JSON | Yes | Extensible position (GPS or Indoor). Must include `type`. |
| `speed` | Float | No | Current speed in meters per second (m/s). |
| `battery_level` | Integer | No | Battery percentage (0-100). |
| `timestamp_ms` | BigInt | Yes | High-precision sync timestamp. |

---

### AI Status & Decisions
`POST /api/ai-hw/ai-logs`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `event_type` | String | Yes | Options: `reroute`, `safety_override`, `rejected_command`, `local_stop`. |
| `component_name` | String | Yes | The AI module name (e.g., `pathfinder_v1`, `lidar_guard`). |
| `decision_context` | JSON | No | The world state at decision time (e.g., obstacle distance). |
| `timestamp_ms` | BigInt | Yes | High-precision sync timestamp. |

---

### Health Sensor Data (Raw)
`POST /api/ai-hw/health-telemetry`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `type` | String | Yes | Sensor type. E.g., `heart_rate`, `temperature`, `motion`. |
| `value` | Float | Yes | The raw numerical value. |
| `sensor_status` | String | Yes | Reliability check. Options: `valid`, `noisy`, `disconnected`. |
| `timestamp_ms` | BigInt | Yes | High-precision sync timestamp. |

---

### Health Predictions (AI Inferred)
`POST /api/ai-hw/health-predictions`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `prediction_type` | String | Yes | Options: `fainting`, `fall`, `posture_anomaly`. |
| `confidence` | Float | Yes | Probability value between `0.0` and `1.0`. |
| `is_critical` | Boolean | Yes | `true` if immediate intervention is required. |
| `source_model` | String | Yes | The specific AI model ID that made the prediction. |
| `prediction_window_ms` | Integer | No | Duration of data used for this prediction in milliseconds. |
| `timestamp_ms` | BigInt | Yes | High-precision sync timestamp. |

---

### Emergency Events
`POST /api/ai-hw/emergency`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `event_type` | String | Yes | The type of emergency (e.g., `collision`, `fall_detected`). |
| `source_classification`| String | Yes | Options: `obstacle`, `health`, `hardware`, `connectivity`, `battery`, `ai_failure`. |
| `severity` | String | Yes | Impact level. Options: `info`, `warning`, `critical`. |
| `timestamp_ms` | BigInt | Yes | High-precision sync timestamp. |

---

## 3. Device Health

### Device Connection Status
`POST /api/ai-hw/device-status`

| Parameter | Type | Required | Description / Options |
| :--- | :--- | :--- | :--- |
| `e_chair_id` | Integer | Yes | The wheelchair ID. |
| `device_name` | String | Yes | Component name (e.g., `Lidar`, `Heart_Sensor`, `Motors`). |
| `connection_status` | String | Yes | Options: `online`, `offline`, `reconnecting`, `degraded_connection`. |
| `firmware_version` | String | No | The current firmware version of the component. |
