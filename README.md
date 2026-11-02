# WSO2 Asgardeo PHP SSO Integration

A secure, lightweight vanilla PHP web application integrated with **WSO2 Asgardeo** using the **OAuth 2.0 / OpenID Connect (OIDC) Authorization Code Flow**. This project demonstrates seamless Single Sign-On (SSO), secure session management, and JWT token parsing to display user claims.

---

## 🚀 Features
- **OIDC Authorization Code Flow**: Secure authentication delegated to WSO2 Asgardeo.
- **Session Management**: Proper session handling and secure destruction upon logout.
- **Cache Control**: Prevents browsers from rendering cached authenticated states after logging out (`no-store`, `no-cache`).
- **JWT Claim Parsing**: Decodes the received `id_token` to dynamically display the authenticated user's email/username.
- **Modern Clean UI**: Styled with a responsive, professional user interface.

---

## 🛠️ Project Structure
```text
asgardeo-app/
│
├── config.php       # Core configurations (Tenant ID, Client ID, Secret, Endpoints)
├── index.php        # Landing page with dynamic UI (Login / User Email / Logout)
├── callback.php     # Handles auth code exchange for access/id tokens via cURL
└── logout.php       # Destroys local session and clears cookies
```
## ⚙️ Prerequisites & Setup

1. Local Server: XAMPP, WAMP, or any PHP server running PHP 7.4+ with cURL enabled.
2. WSO2 Asgardeo Account: Set up a free developer account on WSO2 Asgardeo Console.

## Step-by-Step Configuration:

1. Clone or download this repository into your local server root (e.g., htdocs/asgardeo-app).
2. Create a Traditional Web Application in the Asgardeo Console.
3. Configure your Authorized Redirect URLs:
    http://localhost/asgardeo-app/callback.php
   
    http://localhost/asgardeo-app/index.php
   
5. Update your credentials in config.php:
``` text
PHP
define('ASGARDEO_TENANT', 'YOUR_TENANT_NAME');
define('CLIENT_ID', 'YOUR_CLIENT_ID');
define('CLIENT_SECRET', 'YOUR_CLIENT_SECRET');

```
##🧪 Running the Application

1. Start your Apache server (XAMPP).
2. Open your browser and navigate to:

```text
Plaintext
http://localhost/asgardeo-app/

```
3. Click "Login with Asgardeo", enter your credentials, and explore the secure SSO flow!

##📝 Medium Article
For a detailed step-by-step tutorial on how this integration was built and the challenges overcome, check out the Medium blog post:

##👉 [Read the Full Article on Medium]((https://medium.com/@nipuninethmini2002/securing-a-php-application-with-wso2-asgardeo-a-step-by-step-oidc-sso-guide-8ee0697bf225))

##👤 Author
P. Nipuni Nethmini
