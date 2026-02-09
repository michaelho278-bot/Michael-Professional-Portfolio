# 🛠 ClawBot Troubleshooting Guide

This document covers common issues when installing, pairing, and running ClawBot, along with recommended fixes.

---

## 1️⃣ Gateway Unreachable (`ECONNREFUSED`)
**Symptom:**
Gateway unreachable (connect ECONNREFUSED 127.0.0.1:18789)

Code

**Cause:**
- The Gateway service is not running.
- Port conflict or firewall blocking local loopback.

**Fix:**
powershell
openclaw gateway
Start the Gateway manually.

Verify with:

powershell
openclaw status
If still unreachable, run:

powershell
openclaw gateway --force
to kill any process bound to the port and restart.

## 2️⃣ Channel Login Failed
Symptom:

Code
Channel telegram does not support login
Cause:

Wrong command used (start instead of channels login).

Channel not paired with a valid token.

Fix:

powershell
openclaw channels login --channel telegram
Enter the Telegram Bot Token from BotFather.

Confirm pairing with:

powershell
openclaw status

## 3️⃣ Invalid or Short Token
Symptom:

Code
Gateway token looks short
Cause:

Token is incomplete or not secure enough.

Fix:

Regenerate a new Telegram Bot Token via BotFather.

Update configuration:

powershell
openclaw configure

## 4️⃣ Memory Unavailable
Symptom:

Code
Memory enabled (plugin memory-core) · unavailable
Cause:

Gateway not running, so memory plugin cannot connect.

Fix:

Start Gateway:

powershell
openclaw gateway
Re-check status:

powershell
openclaw status

## 5️⃣ Common Mistakes
Using openclaw start telegram → ❌ Not a valid command.

Forgetting to run openclaw gateway after pairing → ❌ Bot won’t respond.

Not checking openclaw status → ❌ Harder to diagnose issues.

## ✅ Quick Checklist
Run openclaw gateway after every reboot.

Use openclaw channels login --channel telegram for pairing.

Confirm with openclaw status.

Test with openclaw message send.