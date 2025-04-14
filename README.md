# Silken Sip Vineyard 葡萄酒電商平台 - PHP 後端 API

## 專案概述

Silken Sip Vineyard PHP 後端 API 是一個專為葡萄酒電商平台設計的後端服務，提供完整的資料庫操作和業務邏輯處理功能。本系統使用 PHP 開發，為前端 Vue 應用提供 RESTful API 服務，實現產品管理、會員管理、訂單處理、課程管理、優惠券管理等功能。

本專案是為了練習後端技術而開發的作品，展示 PHP 與 MySQL 在電商平台中的實際應用，並提供一個完整的電商系統後端開發經驗。

## 專案結構

```
CID101_G2_php/
├── back/                # 後台管理 API
│   ├── Login/           # 登入相關 API
│   ├── admin/           # 管理員管理 API
│   ├── courseManage/    # 課程管理 API
│   ├── courseOrderManage/ # 課程訂單管理 API
│   ├── discountManage/  # 優惠券管理 API
│   ├── memberManage/    # 會員管理 API
│   ├── newsManage/      # 最新消息管理 API
│   ├── orderManage/     # 訂單管理 API
│   ├── productManage/   # 產品管理 API
│   └── quizManage/      # 測驗管理 API
│
├── front/               # 前台 API
│   ├── SDK_PHP-master/  # 綠界金流 SDK
│   ├── bookinghistory/  # 預約歷史 API
│   ├── cart/            # 購物車 API
│   ├── discounthistory/ # 優惠券歷史 API
│   ├── game/            # 遊戲相關 API
│   ├── home/            # 首頁相關 API
│   ├── member/          # 會員相關 API
│   ├── memberorderhistory/ # 會員訂單歷史 API
│   ├── vendor/          # Composer 相依套件
│   ├── connectDataBase.php # 資料庫連線設定
│   ├── index.php        # 入口檔案
│   └── ...              # 其他 API 檔案
```

## 功能特點

### 前台 API
- **會員系統**：註冊、登入、個人資料管理
- **購物系統**：購物車、結帳流程、訂單管理
- **課程預約**：課程查詢、預約、付款
- **優惠券管理**：優惠券查詢、使用
- **遊戲系統**：品酒達人遊戲 API
- **最新消息**：消息列表、詳情查詢

### 後台 API
- **會員管理**：會員資料查詢、編輯、刪除
- **產品管理**：產品新增、編輯、刪除
- **訂單管理**：訂單查詢、狀態更新
- **課程管理**：課程新增、編輯、刪除
- **優惠券管理**：優惠券創建、編輯、刪除
- **最新消息管理**：消息發佈、編輯、刪除
- **測驗管理**：遊戲題目管理
- **管理員權限**：管理員帳號管理

## 技術架構

- **程式語言**：PHP 7+
- **資料庫**：MySQL
- **API 格式**：RESTful JSON
- **金流整合**：綠界金流 SDK
- **相依管理**：Composer

## 安裝指南

### 環境需求
- PHP 7.4+
- MySQL 5.7+
- Apache 或 Nginx 網頁伺服器
- Composer

### 安裝步驟

1. 複製專案到本地
```sh
git clone [專案 Git 倉庫 URL]
cd CID101_G2_php
```

2. 安裝相依套件
```sh
cd front
composer install
```

3. 資料庫設定
- 建立名為 `cid101_g2` 的 MySQL 資料庫
- 匯入資料庫結構 (SQL 檔案位置待定)
- 根據需要修改 `front/connectDataBase.php` 中的資料庫連線設定

4. 設定網頁伺服器
- 設定 Apache 或 Nginx 將網站根目錄指向專案的 `front` 目錄
- 確保 PHP 能夠正常執行

## 開發指南

### API 使用方式

所有 API 都遵循 RESTful 設計原則，使用 HTTP 方法（GET、POST、PUT、DELETE）進行操作，並返回 JSON 格式的回應。

#### 範例請求

```javascript
// 使用 fetch API 發送請求
fetch('http://localhost/CID101_G2_php/front/getCourse.php')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
```

### 跨域資源共享 (CORS)

本專案已設定 CORS 允許從指定的前端應用訪問 API。如需修改允許的來源，請編輯 `front/connectDataBase.php` 中的 `$allowed_origins` 陣列。

## 部署指南

### 開發環境
- 使用 XAMPP、WAMP 或 MAMP 等本地開發環境
- 設定虛擬主機指向專案目錄

### 生產環境
- 將專案檔案上傳到支援 PHP 和 MySQL 的網頁主機
- 修改 `front/connectDataBase.php` 中的資料庫連線設定為生產環境設定
- 確保所有目錄權限正確設定

## 與前端整合

本後端 API 設計用於與 Vue.js 前端應用整合，提供資料存取和業務邏輯處理。前端應用應通過 HTTP 請求與這些 API 進行通信。

## 安全性考量

- 所有敏感操作都需要進行身份驗證
- 使用 PDO 預處理語句防止 SQL 注入
- 實作 CSRF 防護機制
- 敏感資料加密存儲

## 注意事項

- 本系統包含金流整合，請在測試環境中使用測試帳號
- 生產環境部署前請確保所有安全措施都已正確配置
- 定期備份資料庫資料

## 貢獻指南

如要貢獻程式碼，請遵循以下步驟：
1. Fork 專案
2. 創建功能分支 (`git checkout -b feature/amazing-feature`)
3. 提交變更 (`git commit -m 'feat: 新增某功能'`)
4. 推送到分支 (`git push origin feature/amazing-feature`)
5. 開啟 Pull Request

## 授權資訊

本專案僅供學習和練習使用，未經授權不得用於商業用途。
