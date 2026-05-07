## Categories Endpoints

### 1. List Categories
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/categories`
- **Description:** Lists system and organizational categories. Accommodates tree structure mapping.

#### Request Details
- **Headers:** `Accept: application/json`, `Authorization: Bearer {token}`
- **Query Parameters:**
  - `main_only` (boolean): Fetch only top-level parents.
  - `organization_id` (integer): Filter by a specific organization.
  - `has_places` (boolean): Only fetch categories that possess places.

#### Responses
**Success (200 OK):**
```json
{
  "message": "Categories retrieved successfully.",
  "data": [
    {
      "id": 1,
      "name": "Ramps"
    }
  ]
}
```

### 2. Create Category
#### Endpoint Information
- **HTTP Method:** `POST`
- **Full URL:** `/api/categories`
- **Description:** Registers a new category.

#### Authentication & Authorization
- **Authorization Logic:** Handled via `CategoryPolicy`.
- **Role-based Actions:**
  - Organization users default their parent_id implicitly to their organization's parent_id if unset.

#### Request Body
```json
{
  "name": "Elevators",
  "parent_id": null
}
```

#### Validation Rules
- `name`: `required|string|max:255`
- `parent_id`: `nullable|exists:categories,id`


### 3. Get Category Details
#### Endpoint Information
- **HTTP Method:** `GET`
- **Full URL:** `/api/categories/{id}`

#### Responses
**Success (200 OK):**
```json
{
  "data": {
    "id": 1,
    "name": "Ramps"
  }
}
```

### 4. Update Category
#### Endpoint Information
- **HTTP Method:** `PUT`
- **Full URL:** `/api/categories/{id}`

#### Authorization Logic
- Handled via `CategoryPolicy@update`. You must own it structurally.

#### Request Body
```json
{
  "name": "Wheelchair Ramps"
}
```

### 5. Delete Category
#### Endpoint Information
- **HTTP Method:** `DELETE`
- **Full URL:** `/api/categories/{id}`
- **Description:** Hard deletes the category if permitted.
