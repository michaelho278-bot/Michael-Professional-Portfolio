# Active Directory Lab – Test Checklist

## 1. Basic Functionality Tests
- [ ] Create a new user account and verify domain login
- [ ] Attempt incorrect password to confirm account lockout policy
- [ ] Create Organizational Units (OUs) and test user isolation

## 2. Group Policy (GPO) Tests
- [ ] Create a simple GPO (e.g., disable USB storage / set desktop wallpaper)
- [ ] Verify policy is applied after user login
- [ ] Test OU-level GPO inheritance

## 3. Network & Service Tests
- [ ] DNS: verify domain name resolution from client
- [ ] DHCP: confirm client receives IP automatically, test lease renewal
- [ ] File Sharing: create shared folder, test NTFS permissions
- [ ] Printer Sharing: add network printer, test access control

## 4. Security & Management Tests
- [ ] Password Policy: enforce minimum length / complexity
- [ ] Account Lockout Policy: confirm account locks after repeated failed logins
- [ ] Audit Policy: enable logon/logoff auditing, verify Event Viewer records

## 5. Advanced Tests (Optional)
- [ ] Replication: in multi-DC environment, verify account synchronization
- [ ] Backup & Restore: perform AD backup and test restore procedure
