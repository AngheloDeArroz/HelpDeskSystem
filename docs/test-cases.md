# Test Cases – Ticketing System

This document provides a complete set of manual, API, and edge test cases for the TALL stack–based web application. It covers user registration, authentication, ticket submission, ticket comments, role-based actions, and exceptional scenarios.

---

## Test Scenarios

### Registration Scenarios

1. Register with valid name, email, and password
2. Register without name
3. Register with invalid email domain
4. Register with password less than 8 characters

### Login Scenarios

1. Login with valid credentials
2. Login with invalid email
3. Login with incorrect password

### Ticket Scenarios (User)

1. Submit a ticket with valid details
2. Submit a ticket with empty fields
3. View My Tickets

### Ticket Comment Scenarios

1. User comments on a ticket
2. Support comments on a ticket

### Support Actions

1. Mark ticket as done

### Admin Actions

1. Delete a ticket
2. View users summary

### Role-Based Access Control

1. Users cannot delete tickets
2. Support users cannot delete tickets
3. Only admins can delete tickets
4. Users and support users can comment on tickets

---

## API Test Cases

### Registration API

**Endpoint:** `POST /api/register`

| Test Case                    | Request Body                                                                                           | Expected Response             | Status Code |
| ---------------------------- | ------------------------------------------------------------------------------------------------------ | ----------------------------- | ----------- |
| Register with valid data     | {"name": "John Smith", "email": "[john@example.com](mailto:john@example.com)", "password": "Passw0rd"} | Success message, user created | 201         |
| Register without name        | {"name": "", "email": "[john@example.com](mailto:john@example.com)", "password": "Passw0rd"}           | Validation error for name     | 422         |
| Register with invalid email  | {"name": "John Smith", "email": "[john@gmail.com](mailto:johnmail.com)", "password": "Passw0rd"}     | Validation error for email    | 422         |
| Register with short password | {"name": "John Smith", "email": "[john@example.com](mailto:john@example.com)", "password": "123456"}   | Validation error for password | 422         |

### Login API

**Endpoint:** `POST /api/login`

| Test Case                     | Request Body                                                                      | Expected Response          | Status Code |
| ----------------------------- | --------------------------------------------------------------------------------- | -------------------------- | ----------- |
| Login with valid credentials  | {"email": "[john@example.com](mailto:john@example.com)", "password": "Passw0rd"}  | Access token, user details | 200         |
| Login with invalid email      | {"email": "[john@gmail.com](mailto:john@gmail.com)", "password": "Passw0rd"}      | Error message              | 401         |
| Login with incorrect password | {"email": "[john@example.com](mailto:john@example.com)", "password": "WrongPass"} | Error message              | 401         |

### Ticket API

**Endpoint:** `POST /api/tickets`

| Test Case                       | Request Body                                                                  | Expected Response           | Status Code |
| ------------------------------- | ----------------------------------------------------------------------------- | --------------------------- | ----------- |
| Submit ticket with valid data   | {"title": "Login Issue", "description": "Cannot login", "priority": "Urgent"} | Ticket created successfully | 201         |
| Submit ticket with empty fields | {"title": "", "description": ""}                                              | Validation errors           | 422         |

**Endpoint:** `POST /api/tickets/{id}/comments`

| Test Case                 | Request Body                   | Expected Response | Status Code |
| ------------------------- | ------------------------------ | ----------------- | ----------- |
| User comment on ticket    | {"comment": "Please assist"}   | Comment saved     | 201         |
| Support comment on ticket | {"comment": "We are checking"} | Comment saved     | 201         |

**Endpoint:** `PATCH /api/tickets/{id}/status`

| Test Case                     | Request Body       | Expected Response     | Status Code |
| ----------------------------- | ------------------ | --------------------- | ----------- |
| Mark ticket as done (support) | {"status": "Done"} | Ticket status updated | 200         |

**Endpoint:** `DELETE /api/tickets/{id}`

| Test Case                    | Request Body | Expected Response           | Status Code |
| ---------------------------- | ------------ | --------------------------- | ----------- |
| Delete ticket (admin)        | {}           | Ticket deleted successfully | 200         |
| Delete ticket (user/support) | {}           | Access denied               | 403         |

---

## Edge Cases

### Invalid Role Actions

| Test Case                            | Action                         | Expected Response | Status Code |
| ------------------------------------ | ------------------------------ | ----------------- | ----------- |
| User attempts to delete a ticket     | DELETE /api/tickets/{id}       | Access denied     | 403         |
| Support attempts to delete a ticket  | DELETE /api/tickets/{id}       | Access denied     | 403         |
| User attempts to mark ticket as done | PATCH /api/tickets/{id}/status | Access denied     | 403         |

### Invalid Inputs

| Test Case                           | Input                                                            | Expected Response | Status Code |
| ----------------------------------- | ---------------------------------------------------------------- | ----------------- | ----------- |
| Submit ticket with invalid priority | {"title": "Issue", "description": "Desc", "priority": "Invalid"} | Validation error  | 422         |
| Comment with empty text             | {"comment": ""}                                                  | Validation error  | 422         |
