## 🔧 Intel Graphics Card Troubleshooting – Crash & Fix by Switching to Xorg
## 1. Symptom
系統使用 Intel Integrated Graphics 時，出現以下問題：
桌面環境突然崩潰 / 黑屏。
應用程式（VS Code、瀏覽器）渲染失敗。
dmesg / syslog 出現 GPU hang 訊息。

## 2. Root Cause
Wayland session 下，Intel 驅動（i915）可能因硬件加速 bug 而導致 GPU crash。
部分 notebook / kernel 組合未完全兼容 Wayland。

## 3. Troubleshooting Steps
Step 1: 確認當前顯示模式
bash
echo $XDG_SESSION_TYPE
如果顯示 wayland → 代表你用緊 Wayland。
如果顯示 x11 → 已經係 Xorg。

Step 2: 切換到 Xorg 模式
登出 Ubuntu 桌面。
喺登入畫面（GDM），點擊右下角齒輪圖示。
選擇 Ubuntu on Xorg。
再登入。

Step 3: 驗證
bash
echo $XDG_SESSION_TYPE
應該顯示：

程式碼
x11
Step 4: 測試穩定性
開啟 VS Code、瀏覽器、影片播放。
確認無再出現 GPU hang / 黑屏。

## 4. Consultant‑Style Analysis
原因：Wayland + Intel 驅動未完全穩定，導致硬件加速崩潰。
解決方案：切換到 Xorg 模式，兼容性更高。
效益：
系統穩定性提升。
避免 GPU hang 導致工作中斷。
維持硬件加速效能。

## 5. Conclusion
問題：Intel Graphics 在 Wayland 下崩潰。
解決：切換到 Xorg 模式。
結果：系統恢復穩定，顯示正常。