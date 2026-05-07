# Community Endpoints

### 1. List Posts
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/posts`
- **Description:** Retrieve paginated community posts with likes and comments counts, including the post author.
- **Query Params:**
  - `user_id` (integer, optional): Filter by a specific user.
  - `content` (string, optional): Wildcard search within post content.
  - `created_from` (date, optional): YYYY-MM-DD
  - `created_to` (date, optional): YYYY-MM-DD
  - `sort_by` (string, optional): One of `created_at`, `likes_count`, `comments_count`, `shares_count`.
  - `sort_direction` (string, optional): `asc` or `desc`. Defaults to `desc`.

### 2. View Single Post
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/posts/{post}`
- **Description:** Retrieve a single post natively with its relations loaded. Returns paginated top-level comments directly within the object.
- **Response Format:**
  - `comments.data`: Array of CommentResource objects
  - `comments.next_cursor`, `prev_cursor`

### 3. Create Post
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/posts`
- **Description:** Create a new community post. Supports `multipart/form-data`.
- **Fields:** 
  - `content` (string, optional)
  - `images.*` (file, optional, max: 2048)
  - `files.*` (file, optional, max: 5120)

### 4. Update Post
#### Endpoint Information
- **HTTP Method:** `PUT` / `PATCH`
- **Full URL:** `/api/posts/{post}`
- **Description:** Update the text content of a post.

### 5. Delete Post
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/posts/{post}`
- **Description:** Delete a post. Securely removes associated storage files.

### 6. Share Post
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/posts/{post}/share`
- **Description:** Share an existing post to the authenticated user's feed.
- **Body Params:**
  - `content` (string, optional): Supplementary text for the shared post.

### 7. Toggle Like
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/posts/{post}/like`
- **Description:** Toggle the like status on a specific post. Will appropriately add or remove the like.

### 8. View Community Profile
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/community/users/{user}`
- **Description:** Retrieve a community user's profile and paginated posts.

### 9. Get Post Likes
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/posts/{post}/likes`
- **Description:** Retrieve a paginated list of Users who liked this post.

### 10. Get Post Shares
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/posts/{post}/shares`
- **Description:** Retrieve a paginated list of Users who shared this post.

### 11. Toggle Hide Post
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/posts/{post}/hide`
- **Description:** Toggle the hide status of a specific post for the authenticated user. Hidden posts will not appear in the feed.

### 12. Create Post Comment
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/posts/{post}/comments`
- **Description:** Create a direct top-level comment or nested reply.
- **Body Params:**
  - `content` (string, required): The comment body.
  - `parent_id` (integer, optional): The ID of the parent comment, enabling infinite nesting.

### 13. Update Comment
#### Endpoint Information
- **HTTP Method:** `PUT` / `PATCH`
- **Full URL:** `/api/comments/{comment}`
- **Description:** Edit an existing comment text.
- **Body Params:**
  - `content` (string, required): The new text body.

### 14. Delete Comment
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/comments/{comment}`
- **Description:** Permanently destroy a comment. Authorizes ownership.

### 15. Toggle Comment Like
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/comments/{comment}/like`
- **Description:** Toggle the like status explicitly for a comment.

### 16. Get Comment Likes
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/comments/{comment}/likes`
- **Description:** Retrieve a paginated list of Users who liked this comment.

---
# Profile Endpoints
### Update Language
#### Endpoint Information
- **HTTP Method:** `PUT` / `PATCH`
- **Full URL:** `/api/profile/language`
- **Description:** Update the authenticated user's native application language.
- **Body Params:**
  - `language` (string, required): One of `ar|de|en|fr|ge|hi|ko|vi` bound to ENUM.
