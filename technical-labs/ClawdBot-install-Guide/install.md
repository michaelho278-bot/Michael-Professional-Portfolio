## 🦞 ClawBot Lab Section — Install & Run

## 1️⃣ 安裝 ClawBot CLI
powershell
pnpm install -g openclaw
用 pnpm 全域安裝 ClawBot CLI。

安裝完成後，可以用 openclaw --version 確認版本。

## 2️⃣ 初始化設定
powershell
openclaw setup
建立 ~/.openclaw/openclaw.json 配置檔。

會生成 agent workspace。

或者用互動式設定：

powershell
openclaw onboard
引導式 wizard，幫你設定 gateway、workspace、skills。

## 3️⃣ 配置 Telegram Token
powershell
openclaw configure
輸入由 BotFather 提供嘅 Telegram Bot Token。

選擇 provider（例如 Claude Opus 4.5 thinking）。

## 4️⃣ 啟動 Gateway
powershell
openclaw gateway
啟動本地 WebSocket Gateway (ws://127.0.0.1:18789)。

Gateway 負責接收 Telegram 訊息 → 交畀 provider → 回覆用戶。

## 5️⃣ 檢查狀態
powershell
openclaw status
確認 Gateway reachable。

應該會顯示：

Telegram Channel：ON

Gateway：reachable

Memory：enabled

## 6️⃣ 測試訊息
powershell
openclaw message send --channel telegram --target @yourusername --message "Hello from ClawBot"
測試 bot 是否能夠透過 ClawBot CLI 發送訊息。

如果成功，你嘅 Telegram bot 就會回覆。

✅ 總結
安裝：pnpm install -g openclaw

初始化：openclaw setup / openclaw onboard

配置：openclaw configure（輸入 Telegram token + provider）

運行：openclaw gateway

檢查：openclaw status

測試：openclaw message send