# Support Documentation

### 1. Send Support Message
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/support`
- **Description:** Send a message to the support team.

#### Authentication & Authorization
- **Requires Authentication:** Optional
- **Authorization Logic:** If authenticated, the user's name, email, and phone will be automatically used if not explicitly provided in the request payload.

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+123456789",
  "message": "I need help with my account."
}
```
**Fields:**
- `message` (string, required, max: 5000): The content of the support message.
- `name` (string, optional, max: 255): Sender's name.
- `email` (string, optional, max: 255): Sender's email.
- `phone` (string, optional, max: 20): Sender's phone number.

#### Responses
**Success (201 Created):**
```json
{
  "message": "Your message has been sent successfully.",
  "data": {
    "user_id": null,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+123456789",
    "message": "I need help with my account.",
    "id": 1
  }
}
```
