# Laravel 10 Marketstack 具象狀態傳輸應用程式介面用戶端

Marketstack 提供了免費，安全且易於使用的 API，用於即時訪問所有市場中上市公司的業績，開盤價、收盤價、最高價及最低價的形成則進一步影響價格變化。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/marketstack/eod` 來進行 MarketStack 盤後資訊取得。
- 你可以經由 `/marketstack/intraday` 來進行 MarketStack 日內資訊取得。
- 你可以經由 `/marketstack/tickers` 來進行 MarketStack 股票代碼資訊取得。
- 你可以經由 `/marketstack/exchanges` 來進行 MarketStack 交易所資訊取得。
- 你可以經由 `/marketstack/currencies` 來進行 MarketStack 貨幣資訊取得。
- 你可以經由 `/marketstack/timezones` 來進行 MarketStack 時區資訊取得。

----

## 畫面截圖
![](https://i.imgur.com/VxeGOtD.png)
> 取得一個或多個股票行情的盤後資訊

![](https://i.imgur.com/4bEX7Hg.png)
> 取得間隔短至一分鐘的日內資訊

![](https://i.imgur.com/XYlJe1f.png)
> 取得一個或多個股票代碼資訊

![](https://i.imgur.com/wuF3HGn.png)
> 取得 70 多個證券交易所中的任何一個資訊
