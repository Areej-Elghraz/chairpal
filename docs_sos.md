# E-Chair & SOS Endpoints

## Emergency Contacts

### 1. List Emergency Contacts
- **HTTP Method:** `GET`
- **URL:** `/api/emergency-contacts`
- **Description:** Retrieves all emergency contacts for the authenticated user.
- **Requires Authentication:** Yes

#### Response (200 OK)
```json
{
    "message": "Emergency contacts retrieved successfully.",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "name": "Dad",
            "phone": "+2011678744",
            "created_at": "2026-04-29T00:00:00.000000Z",
            "updated_at": "2026-04-29T00:00:00.000000Z"
        }
    ]
}
```

### 2. Add Emergency Contact
- **HTTP Method:** `POST`
- **URL:** `/api/emergency-contacts`
- **Description:** Adds a new emergency contact.
- **Requires Authentication:** Yes
- **Body:**
  - `name` (string, required)
  - `phone` (string, required, max 20 chars, e.g. `+201012345678`)

#### Response (201 Created)
```json
{
    "message": "Emergency contact added successfully.",
    "data": { ... }
}
```

### 3. Delete Emergency Contact
- **HTTP Method:** `DELETE`
- **URL:** `/api/emergency-contacts/{id}`
- **Description:** Deletes a specific emergency contact.
- **Requires Authentication:** Yes

#### Response (200 OK)
```json
{
    "message": "Emergency contact deleted successfully."
}
```

---

## SOS Feature

### 1. Trigger SOS Alert
- **HTTP Method:** `POST`
- **URL:** `/api/sos`
- **Description:** Triggers an emergency SOS alert. It will mock sending a Push Notification (or SMS) to all emergency contacts with the user's location.
- **Requires Authentication:** Yes
- **Body:**
  - `latitude` (numeric, optional)
  - `longitude` (numeric, optional)

#### Response (200 OK)
```json
{
    "message": "SOS alert sent successfully to 3 contacts."
}
```

### 2. Cancel SOS Alert
- **HTTP Method:** `POST`
- **URL:** `/api/sos/cancel`
- **Description:** Cancels the SOS alert and notifies contacts.
- **Requires Authentication:** Yes

#### Response (200 OK)
```json
{
    "message": "SOS alert cancelled successfully."
}
```

---

## E-Chair Connection & Status

### 1. Verify and Connect E-Chair
- **HTTP Method:** `POST`
- **URL:** `/api/echair/verify`
- **Description:** Verifies a serial number. If valid and not assigned, assigns it to the user.
- **Requires Authentication:** Yes
- **Body:**
  - `serial_number` (string, required)

#### Response (200 OK)
```json
{
    "message": "E-Chair verified and connected successfully.",
    "data": {
        "id": 1,
        "serial_number": "E-CHAIR-X900",
        "model": "X900",
        "status": "active",
        "assigned_to_user_id": 1,
        "created_at": "...",
        "updated_at": "..."
    }
}
```
*Note: Returns 404 if invalid, 403 if already assigned to someone else.*

### 2. Update E-Chair Status
- **HTTP Method:** `POST`
- **URL:** `/api/echair/status`
- **Description:** Receives periodic status updates (like battery level) from the mobile app.
- **Requires Authentication:** Yes
- **Body:**
  - `battery` (integer, optional, 0-100)
  - `status` (string, optional)

#### Response (200 OK)
```json
{
    "message": "E-Chair status updated."
}
```
