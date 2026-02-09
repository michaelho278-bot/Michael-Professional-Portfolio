# VM Health Checklist

Use this checklist after creating a new Virtual Machine (VM) to confirm it is working correctly.

---

## 1. System Information
- [ ] OS installed successfully (Windows 11 / Ubuntu 24.04.3 LTS)
- [ ] Confirm 64-bit system:
  - Windows: `System Type` shows "64-bit Operating System"
  - Ubuntu: `uname -m` → `x86_64`

---

## 2. Network Connectivity
- [ ] VM obtains IP address via DHCP
  - Windows: `ipconfig /all`
  - Ubuntu: `ip addr`
- [ ] Test connectivity to Server VM
  - `ping <Server-IP>`
- [ ] DNS resolution works
  - Windows: `nslookup www.example.com`
  - Ubuntu: `dig www.example.com`

---

## 3. Resource Allocation
- [ ] CPU cores assigned (≥2 recommended)
- [ ] RAM allocated (Windows ≥4GB, Ubuntu ≥2GB)
- [ ] Disk space sufficient (Windows ≥40GB, Ubuntu ≥20GB)

---

## 4. Integration & Tools
- [ ] Guest additions / integration tools installed (VirtualBox Guest Additions / Hyper-V Integration Services)
- [ ] Clipboard sharing / file transfer tested (optional)

---

## 5. Snapshot
- [ ] Snapshot created after clean install
- [ ] Snapshot created after role configuration (e.g., AD, DHCP, DNS)

---

## 6. Lab Readiness
- [ ] VM can communicate with other lab machines
- [ ] VM responds to troubleshooting commands (`ping`, `nslookup`, `dig`)
- [ ] VM ready for incident simulation
