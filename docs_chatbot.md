# ChatBot Endpoints

### 1. List ChatBot Sessions
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/chatbot/sessions`
- **Description:** Get all chatbot sessions for the authenticated user.

### 2. Create ChatBot Session
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/chatbot/sessions`
- **Description:** Create a new chatbot session.
- **Fields:** 
  - `title` (string, optional, default: `New Chat`): The title of the session.

### 3. View ChatBot Session
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/chatbot/sessions/{session}`
- **Description:** Get a specific chatbot session including its messages.

### 4. Delete ChatBot Session
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/chatbot/sessions/{session}`
- **Description:** Delete a specific chatbot session.

### 5. Chat with Bot
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/chatbot/sessions/{session}/chat`
- **Description:** Send a message or media to the chatbot and get a response.
- **Fields:** 
  - `message` (string, optional)
  - `media` (array of files, optional): Max 10MB per file.
  - `system_message` (string, optional, default: `You are a friendly Chatbot.`)
  - `max_tokens` (integer, optional, default: `512`)
  - `temperature` (float, optional, default: `0.7`)
  - `top_p` (float, optional, default: `0.95`)

### 6. React to Bot Message
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/chatbot/messages/{message}/reaction`
- **Description:** Like or dislike a message in the session.
- **Fields:** 
  - `reaction` (string, in: `like`, `dislike`)
