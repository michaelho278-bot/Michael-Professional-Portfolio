# 🖥️ M.2 SSD + Windows 11 Upgrade Lab Guide

## 1. Introduction
- **Objective**: Demonstrate upgrading a notebook with a new M.2 SSD and installing Windows 11.  
- **Use Cases**: Hardware upgrade, system rebuild, disaster recovery.  
- **Expected Outcome**: Clean OS installation, improved performance, enhanced security.  

---

## 2. Preparation
- [ ] Prepare M.2 SSD (NVMe/SATA, e.g., 512GB).  
- [ ] Tools: screwdriver, USB installation media.  
- [ ] Backup old drive data (VM lab, repo folders, documents).  
- [ ] Download Microsoft Media Creation Tool to create bootable USB.  

---

## 3. Hardware Installation
- [ ] Power off notebook, disconnect power, remove battery if possible.  
- [ ] Open bottom cover, locate M.2 slot.  
- [ ] Insert SSD, secure with screw.  
- [ ] Boot into BIOS → verify SSD model and capacity.  

---

## 4. BIOS Configuration
- [ ] Enable **UEFI mode**.  
- [ ] Enable **Secure Boot**.  
- [ ] Ensure **TPM 2.0** is active.  

---

## 5. Windows 11 Installation
- [ ] Boot from USB (F12 Boot Menu).  
- [ ] Select new SSD as installation target.  
- [ ] Installer will automatically format and partition the drive.  
- [ ] Complete installation → boot into Windows 11 desktop.  

---

## 6. Post‑Installation Verification
- [ ] Open **Disk Management** → confirm SSD capacity and partitions.  
- [ ] Install **CrystalDiskInfo** → check health status:  
  - Power On Count ≈ 0  
  - Total Host Writes ≈ 0  
  - Health Status = Good  
- [ ] (Optional) Run **CrystalDiskMark** → record read/write performance.  

---

## 7. Environment Rebuild
- [ ] Install Node.js + npm.  
- [ ] Install Git.  
- [ ] Install VM software (VMware / VirtualBox / Hyper‑V).  
- [ ] Restore repo folders and VM lab files.  
- [ ] Configure environment variables (tokens, gateway keys).  

---

## 8. Troubleshooting
- [ ] SSD not detected in BIOS → check slot and screw.  
- [ ] Windows installation fails → verify USB installer and BIOS settings.  
- [ ] Update issues → record KB numbers, wait for Microsoft patches.  

---

## 9. Consultant‑Style Benefits Analysis
- **Performance**: Faster boot and application load times.  
- **Security**: TPM 2.0 + Secure Boot ensures compliance and protection.  
- **Maintainability**: Clean OS, easier updates, long‑term stability.  

---

## 10. Conclusion
- Successfully installed M.2 SSD and Windows 11.  
- Verified SSD health and performance.  
- Rebuilt environment with repos and VM labs.  
- Upgrade delivers measurable improvements in speed, security, and maintainability.  
