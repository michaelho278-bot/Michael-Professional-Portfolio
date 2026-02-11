# Incident Summary

This document provides a quick overview of all incident reports in **IT-Support-Labs**.  
Each entry highlights the issue, root cause, and resolution steps.

---

## Project-Start-Connecting
- **Problem**: Client could not connect to server in initial lab setup.  
- **Root Cause**: VM network misconfiguration (Internal Network + Promiscuous Mode).  
- **Resolution**: Corrected VirtualBox settings, configured DHCP scope, applied Netplan DHCP.  
- **Evidence**: VirtualBox screenshots, `ip addr`, `ping`, `nslookup` outputs.

---

## DHCP-DNS-Issue
- **Problem**: Clients received IP addresses but failed to resolve domain names.  
- **Root Cause**: DHCP scope misconfigured (Option 006 DNS server missing/wrong).  
- **Resolution**: Corrected DHCP option, restarted DHCP service, renewed client IPs.  
- **Evidence**: `ipconfig /all`, `nslookup`, `dig` outputs before/after fix.

---

## Printer-Issue
- **Problem**: Users unable to print documents; jobs stuck in queue.  
- **Root Cause**: Driver mismatch between server and client OS.  
- **Resolution**: Reinstalled correct printer driver, cleared spooler, tested print job.  
- **Evidence**: Event Viewer logs, screenshot of successful test print.

---

## AD-Login-Issue
- **Problem**: Users failed to log in to Active Directory domain.  
- **Root Cause**: Incorrect Group Policy settings applied to OU.  
- **Resolution**: Adjusted GPO, forced policy update (`gpupdate /force`), verified login.  
- **Evidence**: Error message screenshot, Event Viewer entries, corrected GPO screenshot.

---

## Notes
- All incidents are simulated in a lab environment.  
- Reports include bilingual documentation (English + Cantonese).  
- Evidence provided via screenshots and command outputs.  
- Lessons learned documented for each case to improve future troubleshooting.
