# IT-Support-Labs Roadmap

This document outlines planned incident reports and improvements for the lab repository.  
The roadmap demonstrates continuous learning and expansion of troubleshooting scenarios.

---

## 🎯 Upcoming Incident Reports

- **File Server Permission Issue**  
  - Users unable to access shared folders due to NTFS permission misconfiguration.  
  - Evidence: `icacls`, Event Viewer logs, screenshots of permission settings.  

- **Group Policy Misconfiguration**  
  - Incorrect GPO applied, causing login restrictions or desktop policy errors.  
  - Evidence: `gpresult /r`, GPO editor screenshots, corrected settings.  

- **Network Connectivity Issue**  
  - Client cannot reach server due to firewall or routing misconfiguration.  
  - Evidence: `ping`, `tracert`, firewall rules, corrected configuration.  

- **Email Client Configuration Issue**  
  - Outlook/Thunderbird unable to connect to mail server due to wrong settings.  
  - Evidence: connection logs, screenshots of corrected account setup.  

---

## 🛠️ Planned Improvements

- Add **incident-template.md v2** with extra sections (Command Outputs, Screenshots).  
- Expand **vm-health-checklist.md** with performance metrics (CPU, RAM usage).  
- Create **SUMMARY.md auto-index** script for easier navigation.  
- Add bilingual (English + Cantonese) notes for each incident.  

---

## 📌 Long-Term Goals

- Simulate **security-related incidents** (e.g., account lockout, malware detection).  
- Document **cloud service troubleshooting** (Azure AD, Office 365).  
- Integrate **automation scripts** (PowerShell, Bash) for faster resolution.  
- Maintain continuous updates in **CHANGELOG.md** to track progress.
