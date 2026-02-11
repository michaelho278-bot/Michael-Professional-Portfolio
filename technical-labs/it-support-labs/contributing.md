# Contributing Guidelines

Thank you for contributing to **IT-Support-Labs**.  
This document explains how to add new incident reports, maintain consistency, and follow commit message conventions.

---

## 📂 Repository Structure

it-support-labs/
│
├── README.md
├── docs/
│   ├── incident-template.md
│   ├── vm-health-checklist.md
│   └── git-commit-guidelines.md
│
├── DHCP-DNS-Issue/
│   └── report.md
│   └── screenshots/
│
├── Printer-Issue/
│   └── report.md
│   └── screenshots/
│
└── AD-Login-Issue/
└── report.md
└── screenshots/

---

## 📝 Adding a New Incident Report

1. **Copy the template**  
   - Use `docs/incident-template.md` as the base.  
   - Rename it to `report.md` and place it inside a new incident folder (e.g., `File-Permission-Issue/`).

2. **Fill in details**  
   - Situation, Steps to Reproduce, Troubleshooting, Resolution, Evidence, Lessons Learned.  
   - Add screenshots in a `screenshots/` subfolder.

3. **Update README.md**  
   - Add a link to the new incident report under the Incident Reports section.

---

## 💬 Commit Message Convention

Format:  
<type>: <short description>

### Common Types
- **add**: 新增檔案或功能  
- **update**: 更新現有內容  
- **fix**: 修正錯誤或排版  
- **docs**: 文件相關更新 (README, template, guidelines)  
- **refactor**: 重構結構或改善格式  
- **chore**: 其他雜項 (例如路徑調整)

### Examples
- `add: DHCP-DNS incident report`  
- `update: add screenshots for Printer issue`  
- `fix: typo in AD login report`  
- `docs: add vm-health-checklist.md`  
- `refactor: reorganize repo folder structure`

---

## ✅ Checklist Before Commit
- [ ] Incident report follows template structure  
- [ ] Screenshots placed in correct folder  
- [ ] README.md updated with new incident link  
- [ ] Commit message follows convention  

---

## 🚀 Notes
- All incidents are simulated in a lab environment.  
- Reports should include both **command outputs** and **screenshots** for credibility.  
- Keep language clear and professional (English + Cantonese optional).  
