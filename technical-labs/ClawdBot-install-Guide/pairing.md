🦞 ClawBot Lab Section — Pairing & Gateway

## 1️⃣ 配對 Telegram Channel
powershell
openclaw channels login --channel telegram
輸入由 BotFather 提供嘅 Telegram Bot Token。

完成後 ClawBot 會生成 userID，顯示 Telegram channel 已啟用。

## 2️⃣ 檢查 Channel 狀態
powershell
openclaw status
確認 Telegram channel 已經 ON。

狀態應該顯示：

Channel：Telegram → ON

Detail：token config OK，accounts 1/1

## 3️⃣ 啟動 Gateway
powershell
openclaw gateway
啟動本地 WebSocket Gateway (ws://127.0.0.1:18789)。

Gateway 負責接收 Telegram 訊息 → 交畀 AI provider → 回覆用戶。

⚠️ 如果唔做持久運行，每次開機都要手動 run openclaw gateway。

## 4️⃣ 再次檢查狀態
powershell
openclaw status
確認 Gateway 已經 reachable。

應該會顯示：

Gateway：reachable

Telegram Channel：ON

Memory：enabled

## 5️⃣ 測試訊息
powershell
openclaw message send --channel telegram --target @yourusername --message "Hello from ClawBot"
測試 bot 是否能夠透過 ClawBot CLI 發送訊息。

如果成功，你嘅 Telegram bot 就會回覆。

## ✅ 總結
配對：openclaw channels login --channel telegram

檢查：openclaw status

啟動：openclaw gateway

測試：openclaw message send