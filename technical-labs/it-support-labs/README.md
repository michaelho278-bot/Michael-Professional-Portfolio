# IT-Support-Labs

This repository documents simulated IT support incidents and troubleshooting reports.  
Each incident includes reproduction steps, diagnostic outputs, resolution, and lessons learned. 

--- 

## 📑 Table of Contents 
- [📂 Project Overview](#-project-overview) 
- [🚀 Incident Reports](#-incident-reports) 
- [🛠️ Lab Environment](#️-lab-environment) 
- [📑 Supporting Documents](#-supporting-documents) - [📌 Notes](#-notes)

---

## 📂 Project Overview

it-support-labs/
│
├── README.md                # 主入口，repo 簡介 + Incident 索引
├── CONTRIBUTING.md           # 貢獻規範 (Incident 報告寫法 + Commit message)
├── CHANGELOG.md              # 更新日誌 (版本追蹤)
├── SUMMARY.md                # Incident 報告快速總結
├── roadmap.md                # 未來 Incident 場景計劃
│
├── docs/                     # 文件/規範/範本
│   ├── incident-template.md
│   ├── vm-health-checklist.md
│   └── git-commit-guidelines.md
│
├── Project Start – Connecting/
│   ├── report.md
│   └── screenshots/
│
├── DHCP-DNS-Issue/
│   ├── report.md
│   └── screenshots/
│
├── Printer-Issue/
│   ├── report.md
│   └── screenshots/
│
└── AD-Login-Issue/
    ├── report.md
    └── screenshots/
    
---

## 🚀 Incident Reports

[Project-Start-Connecting/report.md](./Project-Start-Connecting/report.md)  
Initial lab setup: VirtualBox internal network, DHCP/DNS configuration, Ubuntu client connectivity verification.

[DHCP-DNS-Issue/report.md](./DHCP-DNS-Issue/report.md)  
Misconfigured DHCP scope option caused DNS resolution failure. Includes `ipconfig`, `nslookup`, `dig` outputs and resolution steps.

[Printer-Issue/report.md](./Printer-Issue/report.md)  
Network printer driver mismatch leading to print job failures. Contains Event Viewer logs, driver reinstall steps, and successful test print evidence.

[AD-Login-Issue/report.md](./AD-Login-Issue/report.md)  
Active Directory login failure due to incorrect group policy settings. Includes screenshots of error messages, Event Viewer entries, and corrective GPO configuration.
    
---

## 🛠️ Lab Environment

**Server**: Windows Server 2019  
Roles: Active Directory Domain Services (AD DS), DHCP, DNS  
Purpose: Provides core infrastructure services for client testing  

**Clients**:  
Windows 11 (x64) — used for domain join, DHCP/DNS testing, printer troubleshooting  
Ubuntu 24.04.3 LTS (live-server-amd64) — used for cross-platform connectivity and DNS resolution testing  

**Virtualization Platform**: Hyper-V / VirtualBox  
Each VM configured with snapshots for rollback  
Network set to internal lab environment (isolated from production)  

**Tools**:  
PowerShell, Event Viewer (Windows)  
`ping`, `dig`, `nslookup` (Linux/Windows)  
RDP, TeamViewer for remote access  
Git + Markdown for documentation and version control

---

## 📑 Supporting Documents

[docs/incident-template.md](./docs/incident-template.md) — Base template for new incident reports  
[docs/vm-health-checklist.md](./docs/vm-health-checklist.md) — Checklist for validating VM setup  
[docs/git-commit-guidelines.md](./docs/git-commit-guidelines.md) — Commit message conventions  
[CONTRIBUTING.md](./CONTRIBUTING.md) — Workflow and contribution rules  
[CHANGELOG.md](./CHANGELOG.md) — Version history and updates  
[SUMMARY.md](./SUMMARY.md) — Quick overview of all incidents  
[roadmap.md](./roadmap.md) — Future incident scenarios and improvements
