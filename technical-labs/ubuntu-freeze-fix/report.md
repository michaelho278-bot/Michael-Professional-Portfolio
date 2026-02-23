# Ubuntu Freeze Troubleshooting Report
**Author**: Michael Ho  
**Date**: 2026-02-23  
**Device**: Lenovo ThinkPad E580, Ubuntu 24.04 LTS  
**Issue**: System freeze when typing + changing font size in Chrome/Google Docs

## 🔍 Symptoms
- Freeze occurred during real-time editing in Google Docs
- Mouse/keyboard unresponsive, required hard reboot
- No pattern initially, but correlated with WiFi activity

## 🕵️ Investigation Steps
1. Checked `journalctl -f` → Found repeated `rtw88_8821ce: PCIe Bus Error`
2. Identified Realtek RTL8821CE WiFi driver + ASPM conflict
3. Verified with `lspci -k` and `cat /proc/cmdline`

## 🛠️ Solution Applied
1. Added `pcie_aspm=off` to GRUB kernel parameters
2. Ran `sudo apt update && sudo apt upgrade -y` + `linux-firmware`
3. Rebooted and verified with stress test (Chrome + Docs + WiFi load)

## ✅ Verification
- `cat /proc/cmdline | grep pcie_aspm` → confirmed
- `journalctl -f | grep -iE "pcie|rtw88"` → no errors for 24h+
- Stress test: stable under normal workload

## 📚 Learnings
- Log-driven troubleshooting is faster than guesswork
- Hardware power management (ASPM) can conflict with open-source drivers
- Always document fixes for future reference / team sharing

## 🔄 Rollback Plan
- Boot previous kernel via GRUB menu if new driver causes issues
- Keep backup of `/etc/default/grub` before editing