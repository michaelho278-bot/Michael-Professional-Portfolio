# 🦞 ClawBot Lab Guide

ClawBot is a CLI framework that integrates Telegram bots, AI providers, and a memory layer.  
This Lab Guide explains how to install, configure, pair, and run ClawBot.

---

## 📦 Install ClawBot CLI
powershell
pnpm install -g openclaw
Install ClawBot CLI globally using pnpm.

Verify installation with:

powershell
openclaw --version

## ⚙️ Initialize Setup
powershell
openclaw setup
Creates ~/.openclaw/openclaw.json configuration file.

Generates the agent workspace.

Or use the interactive wizard:

powershell
openclaw onboard
Guides you through gateway, workspace, and skills setup.

## 🔑 Configure Telegram Token
powershell
openclaw configure
Enter the Telegram Bot Token provided by BotFather.

Select your AI provider (e.g., Claude Opus 4.5 thinking).

## 🔄 Pairing Lab Section
1. Pair Telegram Channel
powershell
openclaw channels login --channel telegram
Completes Telegram channel pairing.

Generates a userID once pairing is successful.

2. Check Channel Status
powershell
openclaw status
Confirms Telegram channel is ON and token is valid.

## 🚀 Start Gateway
powershell
openclaw gateway
Launches the local WebSocket Gateway (ws://127.0.0.1:18789).

The Gateway handles incoming Telegram messages → AI provider → replies.

⚠️ If you don’t set up persistent running, you must manually run openclaw gateway every time you boot your system.

## 📊 Verify Status
powershell
openclaw status
Confirms Gateway is reachable.

Expected output:

Telegram Channel: ON

Gateway: reachable

Memory: enabled

## 💬 Test Message
powershell
openclaw message send --channel telegram --target @yourusername --message "Hello from ClawBot"
Sends a test message through ClawBot CLI.

If successful, your Telegram bot will reply.

## ✅ Summary
Install: pnpm install -g openclaw

Initialize: openclaw setup / openclaw onboard

Configure: openclaw configure (Telegram token + provider)

Pair: openclaw channels login --channel telegram

Run: openclaw gateway

Check: openclaw status

Test: openclaw message send