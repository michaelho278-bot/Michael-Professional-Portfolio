# Secure Boot & MOK Enrollment Guide (Linux)

## Background
When installing VirtualBox or other software that requires third-party drivers, systems with **UEFI Secure Boot** enabled need additional configuration.  
Secure Boot only allows signed drivers to load, so the system generates a **Machine Owner Key (MOK)** that must be manually enrolled by the user.

---

## Steps

### 1. Installation Prompt
During installation, you may see:
Your system has UEFI Secure Boot enabled.
A new Machine-Owner Key (MOK) has been generated.
You must choose a password now and confirm after reboot.

---

### 2. Set a Password
- Select `<Ok>`  
- Enter a temporary password (simple is fine, but remember it)  

### 3. Reboot the System
- On reboot, the system will enter the **MOK Manager** screen  
- Choose:
  - `Enroll MOK`
  - `Continue`
  - `Yes`
  - Enter the password you set earlier
  - `Confirm`

### 4. Complete Enrollment
- The driver will now be accepted by Secure Boot  
- VirtualBox and other third-party modules can load normally  

---

## Common Issues
- **Forgot password**: Reinstall the driver; the system will generate a new MOK.  
- **Skipped enrollment**: VirtualBox kernel modules may fail to load.  
- **Security note**: MOK ensures that the change is authorized by you, not malware.  

---

## Summary
By enrolling the MOK, you can keep Secure Boot enabled while allowing VirtualBox and other third-party drivers to run safely.
