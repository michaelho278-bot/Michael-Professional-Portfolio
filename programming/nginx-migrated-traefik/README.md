# Traefik Migration: Nginx to IngressRoute (K8s Simulation)

## 🎯 Objective
This project demonstrates a migration from a legacy **Nginx** `auth_request` setup to **Traefik** using **ForwardAuth Middleware**. 

The configuration strictly follows the requirement to simulate a **Kubernetes environment** by utilizing:
- **File Provider**: Dynamic configuration via YAML files.
- **IngressRoute CRDs**: Defining routes and middleware declaratively, mimicking K8s Custom Resource Definitions.
- **No Docker Auto-Discovery**: Explicitly disabled Docker provider to ensure all routing logic resides in YAML files, matching the target cluster behavior.

---

## 🏗 Architecture

### Components
1.  **Traefik (v3.4)**: Acts as the Ingress Controller.
    - Configured via `traefik/traefik.yml` (Static) and `traefik/dynamic/ingressroute.yml` (Dynamic).
    - **Security Note**: Docker Socket mount is **removed** to follow the Principle of Least Privilege, as routing is fully defined in files.
2.  **Auth Service**: A Python Flask application (`auth.py`) that validates the `x-pretest` header.
    - Returns `200 OK` for valid tokens.
    - Returns `401 Unauthorized` for invalid/missing tokens.
3.  **Hello App**: A mock backend (`nginxdemos/hello`) representing the protected application.

### Flow Diagram
```text
User Request 
   │
   ▼
[Traefik EntryPoint]
   │
   ├─► Path: /auth ──► [Auth Service] (No Auth Middleware)
   │
   └─► Path: / ──► [ForwardAuth Middleware] ──► [Auth Service]
                      │
                      ├─ 401 ──► Return 401 to User
                      │
                      └─ 200 ──► Proxy to [Hello App]
```

---

## 🚀 Quick Start

### Prerequisites
    - Docker & Docker Compose installed.
    - Port 80 and 8080 available on your host.
### Run the Stack
```powershell
docker-compose up --build
```
### Verify Services
Once started, you should see:
    - traefik: Running on port 80 (Web) and 8080 (Dashboard).
    - auth-service: Running internally on port 5000.
    - hello-app: Running internally on port 80.

---

## 🧪 Testing & Verification
Use the following commands to verify the authentication flow.
1. Test Unauthorized Access (Expected: 401)
Sending a request without the token should be blocked by Traefik.
```powershell
# PowerShell
Invoke-WebRequest http://localhost -UseBasicParsing
# Output: Invoke-WebRequest : 远程服务器返回错误: (401) 未经授权。
```
2. Test Authorized Access (Expected: 200 + Hello World)
Sending a request with the valid x-pretest header should pass through to the Hello App.
```powershell
# PowerShell
Invoke-WebRequest http://localhost -Headers @{ "x-pretest" = "valid-token" } -UseBasicParsing
# Output: StatusCode : 200, Content contains "Hello World" HTML
```
3. Test Invalid Token (Expected: 401)
```powershell
# PowerShell
Invoke-WebRequest http://localhost -Headers @{ "x-pretest" = "wrong-token" } -UseBasicParsing
# Output: Invoke-WebRequest : 远程服务器返回错误: (401) 未经授权。
```

📂 Project Structure
```powershell
.
├── auth/
│   ├── Dockerfile
│   └── auth.py              # Flask Auth Service
├── traefik/
│   ├── traefik.yml          # Static Config (File Provider enabled)
│   └── dynamic/
│       └── ingressroute.yml # Dynamic Config (IngressRoute + ForwardAuth)
├── docker-compose.yml       # Orchestration (No Docker Socket for Traefik)
└── README.md
```

---

## 💡 Key Design Decisions
|Decision                         |Reason                           |
|---------------------------------|---------------------------------|
| File Provider over Docker Provider   | To strictly simulate the K8s environment where config is managed via YAML/CRDs, not container labels. |
| Removed Docker Socket           | Enhances security (Least Privilege). Since routes are static in YAML, Traefik doesn't need to listen to Docker events. |
| Mock Backend (nginxdemos/hello) | Provides a visual confirmation (200 OK with content) that the proxy chain is working end-to-end. |
| Explicit Routes for Auth        | Defined a separate router for /auth without middleware to prevent infinite authentication loops. |

---

## 📝 Git Commit Strategy
This repository follows a logical commit history to reflect the migration steps:
1. docs: define migration strategy from Nginx to Traefik with K8s simulation
2. feat: migrate to Traefik with ForwardAuth and File Provider configuration
3. chore: enhance security by removing unused Docker Socket and cleanup config

---

Prepared by Michael Ho for Oursky Pre-test