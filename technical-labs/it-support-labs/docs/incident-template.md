# Incident Report — [Incident Title]

**Date**: YYYY-MM-DD  
**Environment**:  
- Server: Windows Server 2019 (roles: AD DS, DHCP, DNS)  
- Clients: Windows 10 / 11, Ubuntu 24.04.3 LTS  
- Virtualization: Hyper-V / VirtualBox  

---

## 1. Situation
[簡述問題背景，例如：用戶報告無法登入 / 無法列印 / 無法解析域名]

---

## 2. Steps to Reproduce
1. [Step 1 — 配置或操作]  
2. [Step 2 — 模擬錯誤]  
3. [Step 3 — 驗證問題出現]

---

## 3. Troubleshooting
**Windows Client**  
- `ipconfig /all` → [結果]  
- `nslookup` → [結果]  
- Event Viewer → [錯誤訊息]

**Ubuntu Client**  
- `ip addr` → [結果]  
- `cat /etc/resolv.conf` → [結果]  
- `dig` → [結果]

---

## 4. Resolution
- [修正步驟，例如：修改 DHCP Option 006，重啟服務]  
- [Client 端更新設定，例如：`ipconfig /renew` 或 `systemctl restart systemd-resolved`]  
- [驗證問題已解決]

---

## 5. Evidence
- Screenshot: [放截圖位置]  
- Command Output: [放命令輸出]  
- Diagram: [可選，網絡拓撲圖]

---

## 6. Lessons Learned / Future Improvement
- [例如：建立 checklist，避免配置錯誤]  
- [例如：加強監控 DHCP/DNS logs]  
- [例如：建立 snapshot，方便 rollback]
