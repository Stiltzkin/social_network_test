---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->
# 1. Social Network API

Social Network API Documentation to view profiles, create and like new posts, follow users and get users with most likes based on location.

#2. Address

Address endpoints.
<!-- START_f731c9ff9b0115968cdf458f0de18b5d -->
## Addresses list

List of all addresses.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/addresses" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/addresses");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "zip_code": "endereco 1"
        },
        {
            "id": 2,
            "zip_code": "endereco 2"
        },
        {
            "id": 3,
            "zip_code": "endereco 3"
        },
        {
            "id": 4,
            "zip_code": "endereco 3"
        }
    ]
}
```

### HTTP Request
`GET api/v1/addresses`


<!-- END_f731c9ff9b0115968cdf458f0de18b5d -->

<!-- START_f7ad1cf021c78e0a642abaabf859a9ce -->
## Create

Creates a new address

> Example request:

```bash
curl -X POST "http://localhost/api/v1/addresses" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/addresses");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "Address created successfully!",
    "data": {
        "zip_code": "endereco 4",
        "id": 5
    }
}
```
> Example response (422):

```json
{
    "errors": {
        "zip_code": [
            "The zip code field is required."
        ]
    },
    "status": false
}
```

### HTTP Request
`POST api/v1/addresses`


<!-- END_f7ad1cf021c78e0a642abaabf859a9ce -->

#3. User

User endpoints.
<!-- START_54e79987a234dc031c8810d8bb2fa237 -->
## api/v1/test
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/test" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/test");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET api/v1/test`


<!-- END_54e79987a234dc031c8810d8bb2fa237 -->

<!-- START_4194ceb9a20b7f80b61d14d44df366b4 -->
## Create

Creates a new user.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/users" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"facilis","email":"eveniet","password":"perferendis","photo":"animi"}'

```

```javascript
const url = new URL("http://localhost/api/v1/users");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "facilis",
    "email": "eveniet",
    "password": "perferendis",
    "photo": "animi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "User created successfully!",
    "data": {
        "name": "usuario 5",
        "email": "email5@email",
        "address_id": 2,
        "updated_at": "2019-10-09 18:17:32",
        "created_at": "2019-10-09 18:17:32",
        "id": 5
    }
}
```
> Example response (422):

```json
{
    "errors": {
        "name": [
            "The name field is required."
        ],
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    },
    "status": false
}
```

### HTTP Request
`POST api/v1/users`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | User`s name
    email | string |  required  | User`s email
    password | string |  required  | User`s password
    photo | file |  optional  | User`s image

<!-- END_4194ceb9a20b7f80b61d14d44df366b4 -->

<!-- START_cedc85e856362e0e3b46f5dcd9f8f5d0 -->
## Details

Get details of an user.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/users/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/users/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
null
```
> Example response (200):

```json
{
    "data": {
        "id": 1,
        "address_id": 1,
        "name": "usuario 1",
        "email": "email1@email",
        "email_verified_at": null,
        "photo": null,
        "created_at": "2019-10-08 19:18:42",
        "updated_at": "2019-10-08 19:18:42",
        "addresses": {
            "id": 1,
            "zip_code": "endereco 1"
        },
        "follows": [],
        "posts": [
            {
                "id": 1,
                "user_id": 1,
                "name": "post 1 do usuario 1",
                "photo": null,
                "description": "praia",
                "created_at": "2019-10-08 19:19:01",
                "updated_at": "2019-10-08 19:19:01"
            },
            {
                "id": 2,
                "user_id": 1,
                "name": "post 2 do usuario 1",
                "photo": null,
                "description": "praia",
                "created_at": "2019-10-08 19:19:10",
                "updated_at": "2019-10-08 19:19:10"
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/users/{user}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | User id.

<!-- END_cedc85e856362e0e3b46f5dcd9f8f5d0 -->

<!-- START_9024904198f65018982c3e846de601b1 -->
## Follow

Follows an user.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/users/follow/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/users/follow/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "Following"
}
```
> Example response (404):

```json
null
```

### HTTP Request
`GET api/v1/users/follow/{user_id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | User to be followed id.

<!-- END_9024904198f65018982c3e846de601b1 -->

#4. Feed

Feed endpoints.
<!-- START_8c8dee3dc083fa8a3bbfd25342a7c1b6 -->
## Create

Creates a new post.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/posts" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"aspernatur","description":"incidunt","photo":"dolorem"}'

```

```javascript
const url = new URL("http://localhost/api/v1/posts");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "aspernatur",
    "description": "incidunt",
    "photo": "dolorem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "Feed posted successfully!",
    "data": {
        "name": "post 1 do usuario 3",
        "description": "praia",
        "photo": null,
        "user_id": 4,
        "updated_at": "2019-10-09 18:39:35",
        "created_at": "2019-10-09 18:39:35",
        "id": 7
    }
}
```
> Example response (422):

```json
{
    "errors": {
        "name": [
            "The name field is required."
        ],
        "description": [
            "The description field is required."
        ]
    },
    "status": false
}
```

### HTTP Request
`POST api/v1/posts`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Feed`s title
    description | string |  required  | Feed`s message
    photo | file |  optional  | Feed`s image

<!-- END_8c8dee3dc083fa8a3bbfd25342a7c1b6 -->

<!-- START_0a4452675c47dd92270900d7a1e7d281 -->
## Details

Get feed`s details and who liked it.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/posts/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/posts/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "Feed posted successfully!",
    "data": {
        "name": "post 1 do usuario 3",
        "description": "praia",
        "photo": null,
        "user_id": 4,
        "updated_at": "2019-10-09 18:39:35",
        "created_at": "2019-10-09 18:39:35",
        "id": 7
    }
}
```
> Example response (422):

```json
{
    "errors": {
        "name": [
            "The name field is required."
        ],
        "description": [
            "The description field is required."
        ]
    },
    "status": false
}
```

### HTTP Request
`GET api/v1/posts/{post}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | Post id.

<!-- END_0a4452675c47dd92270900d7a1e7d281 -->

#5. Like

Like endpoints.
<!-- START_357102e5c163339aec5a90c3563daf51 -->
## Like

Likes or dislike a post.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/like/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/like/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "msg": "Liked"
}
```
> Example response (404):

```json
{
    "msg": "Feed not found."
}
```

### HTTP Request
`GET api/v1/like/{feed_id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | Post id.

<!-- END_357102e5c163339aec5a90c3563daf51 -->

<!-- START_918054cca1f473226bbe64659a6bb4e5 -->
## Most likes in a location

List of users with most likes in a location.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/like/bylocation/1" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json"
```

```javascript
const url = new URL("http://localhost/api/v1/like/bylocation/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "user_id": 2,
            "likes": "3"
        },
        {
            "user_id": 3,
            "likes": "1"
        }
    ]
}
```

### HTTP Request
`GET api/v1/like/bylocation/{address_id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | Address id.

<!-- END_918054cca1f473226bbe64659a6bb4e5 -->

#Log in


<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

Authenticate an user.

> Example request:

```bash
curl -X POST "http://localhost/oauth/token" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"client_id":"qui","client_secret":"dolorem","grant_type":"numquam","username":"architecto","password":"nulla"}'

```

```javascript
const url = new URL("http://localhost/oauth/token");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "client_id": "qui",
    "client_secret": "dolorem",
    "grant_type": "numquam",
    "username": "architecto",
    "password": "nulla"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "error": "invalid_credentials",
    "error_description": "The user credentials were incorrect.",
    "message": "The user credentials were incorrect."
}
```
> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31622400,
    "access_token": "{token}",
    "refresh_token": "{refresh_token}"
}
```

### HTTP Request
`POST oauth/token`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    client_id | string |  required  | Provided by the API`s owner
    client_secret | string |  required  | Provided by the API`s owner
    grant_type | string |  required  | Provided by the API`s owner
    username | string |  required  | User`s email
    password | string |  required  | User`s password

<!-- END_a09d20357336aa979ecd8e3972ac9168 -->


