## Authentication Endpoints

### 1. Register a new user
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/signup`
- **Description:** Registers a new user account with ChairPal.

#### Authentication & Authorization
- **Requires Authentication:** No
- **Authorization Logic:** None
- **Allowed Roles:** Guest
- **Role-based Actions:** N/A

#### Request Details
- **Headers:** `Accept: application/json`
- **Query Parameters:** None
- **Path Parameters:** None

#### Request Body
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "user"
}
```
**Fields:**
- `name` (string, required): Full name of the user. Validation: `required, string, max:255`
- `email` (string, required): User's email address. Validation: `required, email, max:255, unique:users`
- `password` (string, required): User's password. Validation: `required, string, min:6, confirmed`
- `password_confirmation` (string, required): Must match `password`.
- `role` (string, required): The role being registered (`user` or `organization`). Validation: `required, in:user,organization`

#### Validation Rules
- `name`: `required|string|max:255`
- `email`: `required|string|email|max:255|unique:users`
- `password`: `required|string|min:6|confirmed`
- `role`: `required|in:user,organization`
- *Constraints*: Passwords must match and email must be unique.

#### Responses
**Success (201 Created):**
```json
{
  "message": "Welcome to ChairPal! Please verify your email with the code we’ve sent to you.",
  "data": []
}
```
**Error Responses:**
- **422 Unprocessable Entity:** Validation failure (e.g., email already taken).

#### Business Logic Notes
- Creates a new `User` record.
- Triggers an email verification code (OTP) to be sent to the registered email.
- Account is initially unverified until `/api/verify-email` is completed.

#### Additional Notes
- Passwords are encrypted before storing.


### 2. Login User
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/login`
- **Description:** Authenticates a user and returns an access token.

#### Authentication & Authorization
- **Requires Authentication:** No
- **Authorization Logic:** None
- **Allowed Roles:** Guest

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "email": "jane@example.com",
  "password": "password123",
  "remember": true
}
```
**Fields:**
- `email` (string, required): User's email address.
- `password` (string, required): User's password.
- `remember` (boolean, optional): Whether to issue a long-lived remember token.

#### Validation Rules
- `email`: `required|email|exists:users,email`
- `password`: `required|string|min:6`
- `remember`: `sometimes|boolean`

#### Responses
**Success (200 OK):**
```json
{
  "message": "Logged in successfully.",
  "data": {
    "data": {
      "id": 1,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "role": "user"
    },
    "access_token": "1|token...",
    "access_token_expires_in": 7200,
    "remember_token": "2|token...",
    "remember_token_expires_in": 1209600
  }
}
```
**Error Responses:**
- **401 Unauthorized:** Invalid credentials.
- **422 Unprocessable Entity:** Fields missing or invalid format.

#### Business Logic Notes
- Validates credentials against DB.
- Returns short-lived `access_token` via Laravel Sanctum and optionally `remember_token`.

#### Additional Notes
- If the account isn't verified, it might restrict certain actions later, but login itself parses.


### 3. Refresh Token
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/refresh-token`
- **Description:** Get a new access token using a valid remember token.

#### Authentication & Authorization
- **Requires Authentication:** Yes (Bearer Token)
- **Authorization Logic:** Requires Sanctum token with `remember` ability.
- **Allowed Roles:** User, Organization, Admin

#### Request Details
- **Headers:** `Accept: application/json`, `Authorization: Bearer {remember_token}`

#### Request Body
*None*

#### Validation Rules
- *No custom body fields.*

#### Responses
**Success (200 OK):**
```json
{
  "message": "Token Refreshed successfully.",
  "data": {
    "access_token": "3|new_token...",
    "access_token_expires_in": 7200
  }
}
```
**Error Responses:**
- **401 Unauthorized:** Missing or invalid token.

#### Business Logic Notes
- Re-issues an `access_token` so the user stays logged in without prompting password again.


### 4. Logout User
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/logout`
- **Description:** Logs out the currently authenticated user by revoking tokens.

#### Authentication & Authorization
- **Requires Authentication:** Yes (Bearer Token)
- **Authorization Logic:** Sanctum auth verification.

#### Request Details
- **Headers:** `Accept: application/json`, `Authorization: Bearer {access_token}`

#### Request Body
*None*

#### Responses
**Success (200 OK):**
```json
{
  "message": "You have been logged out successfully.",
  "data": []
}
```

#### Business Logic Notes
- Revokes the current access token. Devices using this token will need to log in again.


### 5. Forget Password
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/forget-password`
- **Description:** Triggers an OTP code to the user's email for password resetting.

#### Authentication & Authorization
- **Requires Authentication:** No

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "email": "jane@example.com"
}
```
**Fields:**
- `email` (string, required): The target email account.

#### Responses
**Success (200 OK):**
```json
{
  "message": "The Verification code (OTP) has been sent to your email.",
  "data": []
}
```


### 6. Verify OTP
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/verify-otp`
- **Description:** Verifies an OTP code for resetting passwords.

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "email": "jane@example.com",
  "otp": "123456"
}
```
**Fields:**
- `email` (string, required)
- `otp` (string, required): The 4-6 digit code received via email.

#### Responses
**Success (200 OK):**
```json
{
  "message": "Awesome! Your Verification code (OTP) has been verified successfully.",
  "data": []
}
```

### 7. Reset Password
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/reset-password`
- **Description:** Sets a new password after successful OTP verification.

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "email": "jane@example.com",
  "password": "newpassword123",
  "password_confirmation": "newpassword123",
  "token": "reset_token_here"
}
```
**Fields:**
- `email` (string, required)
- `password` (string, required): Minimum 6 characters.
- `password_confirmation` (string, required)
- `token` (string, required): The token from password reset workflow.

#### Responses
**Success (200 OK):**
```json
{
  "message": "Password has been reset successfully.",
  "data": []
}
```

### 8. Verify Email
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/verify-email`
- **Description:** Verifies user account email after signup.

#### Request Details
- **Headers:** `Accept: application/json`

#### Request Body
```json
{
  "email": "jane@example.com",
  "otp": "123456"
}
```

#### Responses
**Success (200 OK):**
```json
{
  "message": "Awesome! Your email has been verified successfully.",
  "data": []
}
```
