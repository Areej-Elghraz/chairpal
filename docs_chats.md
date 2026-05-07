# Chats Endpoints

### 1. List Chats
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/chats`
- **Description:** Get all chat conversations for the authenticated user, including the partner user information, the last message sent, and a count of unread messages.
- **Query Params:** 
  - `search` (string, optional): Searches internally for matching chat partner names or message content.
  - `filter` (string, optional): Pass `unread` to filter only chats with an unread message.

### 2. View Chat Messages
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/chats/{user_id}`
- **Description:** Get paginated messages belonging to the conversation between the authenticated user and another user specified by `{user_id}`. Automatically marks all unread messages sent by the partner as read.

### 3. Send Message
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/chats/{user_id}`
- **Description:** Send a message to another user. Supports raw content payload, or `multipart/form-data` if an attachment is provided.
- **Fields:** 
  - `content` (string, required without attachment)
  - `attachment` (file, required without content, max 5MB). Automatically detected and stored as `voice`, `image`, `text_image`, or standard `file` based on its MIME type.

### 4. Delete Chat
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/chats/{user_id}`
- **Description:** Deletes an entire conversation.
- **Query Params:** 
  - `type` (string, optional, default: `for_me`): Determines deletion scope. Options: `for_me`, `for_both`. Deleting "for both" physically removes DB records, "for me" hides them until a new message revives the thread.

### 5. Update Message
#### Endpoint Information
- **HTTP Method:** `PUT` / `PATCH`
- **Full URL:** `/api/messages/{message_id}`
- **Description:** Updates the text content of a previously sent message. Only the sender can update the message.
- **Fields:**
  - `content` (string, required)

### 6. Delete Message
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/messages/{message_id}`
- **Description:** Deletes a specific message.
- **Query Params:** 
  - `type` (string, optional, default: `for_me`): Determines deletion scope. Options: `for_me`, `for_both`. Only the sender can delete a message `for_both`.
