<?php

namespace App\Http\Controllers;

use App\Services\MarketstackService;
use Carbon\Carbon;

class StockMarketController extends Controller
{
    private $marketstackService;

    /**
     * Instantiate a new StockMarketController instance.
     *
     * @param MarketstackService $marketstackService
     *
     * @return Response
     */
    public function __construct(MarketstackService $marketstackService)
    {
        $this->marketstackService = $marketstackService;
    }

    /**
     * Get end of day.
     *
     * @return Response
     */
    public function getEndOfDay()
    {
        $endOfFayAry = $this->marketstackService->makeHttpRequest('eod', [
           // 'date_from' => Carbon::today()->format(Y-m-d),
           // 'date_to'   => Carbon::today()->format(Y-m-d),
           'limit'     => 1,
           'offset'    => 0,
           'sort'      => 'DESC',
           'symbols'   => 'AAPL'
        ]);
        foreach ($endOfFayAry['data'] as $valueAry) {
            echo '原始開盤價：' . $valueAry['open'] . PHP_EOL;
            echo '原始高價：' . $valueAry['high'] . PHP_EOL;
            echo '原始低價：' . $valueAry['low'] . PHP_EOL;
            echo '原始收盤價：' . $valueAry['close'] . PHP_EOL;
            echo '原始交易量：' . $valueAry['volume'] . PHP_EOL;
            echo '調整後最高價：' . $valueAry['adj_high'] . PHP_EOL;
            echo '調整後低價：' . $valueAry['adj_low'] . PHP_EOL;
            echo '調整後收盤價：' . $valueAry['adj_close'] . PHP_EOL;
            echo '調整後開盤價：' . $valueAry['adj_open'] . PHP_EOL;
            echo '調整量：' . $valueAry['adj_volume'] . PHP_EOL;
            echo '拆分因子：' . $valueAry['split_factor'] . PHP_EOL;
            echo '股票代碼：' . $valueAry['symbol'] . PHP_EOL;
            echo '交換麥格理基礎設施公司（MIC）標識：' . $valueAry['exchange'] . PHP_EOL;
            echo '日期：' .  Carbon::parse($valueAry['date'])->setTimezone('Asia/Taipei')->format('Y-m-d H:i:s') . PHP_EOL;
        }
    }

    /**
     * Get intraday.
     *
     * @return Response
     */
    public function getIntraday()
    {
        $intradayAry = ($this->marketstackService->makeHttpRequest('intraday', [
            //'interval' => '1h',
            'limit'   => 1,
            'offset'  => 0,
            'sort'    => 'DESC',
            'symbols' => 'AAPL' // AAPL,MSFT
        ]));
        foreach ($intradayAry['data'] as $valueAry) {
            echo '原始開盤價：' . $valueAry['open'] . PHP_EOL;
            echo '原始高價：' . $valueAry['high'] . PHP_EOL;
            echo '原始低價：' . $valueAry['low'] . PHP_EOL;
            echo '原始收盤價：' . $valueAry['close'] . PHP_EOL;
            echo '上次執行的交易：' . $valueAry['last'] . PHP_EOL;
            echo '交易量：' . $valueAry['volume'] . PHP_EOL;
            echo '股票代碼：' . $valueAry['symbol'] . PHP_EOL;
            echo '交換麥格理基礎設施公司（MIC）標識：' . $valueAry['exchange'] . PHP_EOL;
            echo '日期：' .  Carbon::parse($valueAry['date'])->setTimezone('Asia/Taipei')->format('Y-m-d H:i:s') . PHP_EOL;
        }
    }

    /**
     * Get tickers.
     *
     * @return Response
     */
    public function getTickers()
    {
        $tickersAry = $this->marketstackService->makeHttpRequest('tickers', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($tickersAry['data'] as $valueAry) {
            echo '名稱：' . $valueAry['name'] . PHP_EOL;
            echo '符號：' . $valueAry['symbol'] . PHP_EOL;
            echo '是否有日內：' . $valueAry['has_intraday'] . PHP_EOL;
            echo '是否有盤後：' . $valueAry['has_eod'] . PHP_EOL;
            echo '國家：' . $valueAry['country'] . PHP_EOL;
            echo '證券交易所的名稱：' . $valueAry['stock_exchange']['name'] . PHP_EOL;
            echo '證券交易所的首字母縮寫：' . $valueAry['stock_exchange']['acronym'] . PHP_EOL;
            echo '證券交易所的麥格理基礎設施公司（MIC）標識：' . $valueAry['stock_exchange']['mic'] . PHP_EOL;
            echo '證券交易所所在的國家：' . $valueAry['stock_exchange']['country']. PHP_EOL;
            echo '證券交易所的 3 字母國家代碼：' . $valueAry['stock_exchange']['country_code']. PHP_EOL;
            echo '證券交易所所在城市：' . $valueAry['stock_exchange']['city']. PHP_EOL;
            echo '證券交易所的網站網址：' . $valueAry['stock_exchange']['website']. PHP_EOL;
        }
    }

    /**
     * Get exchanges.
     *
     * @return Response
     */
    public function getExchanges()
    {
        $exchangesAry = $this->marketstackService->makeHttpRequest('exchanges', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($exchangesAry['data'] as $valueAry) {
            echo '名稱：' . $valueAry['name'] . PHP_EOL;
            echo '縮寫：' . $valueAry['acronym'] . PHP_EOL;
            echo '麥格理基礎設施公司（MIC）標識：' . $valueAry['mic'] . PHP_EOL;
            echo '國家：' . $valueAry['country'] . PHP_EOL;
            echo '3 字母國家代碼：' . $valueAry['country_code'] . PHP_EOL;
            echo '給定城市：' . $valueAry['city'] . PHP_EOL;
            echo '網站網址：' . $valueAry['website'] . PHP_EOL;
            echo '時區名稱：' . $valueAry['timezone']['timezone'] . PHP_EOL;
            echo '時區縮寫：' . $valueAry['timezone']['abbr'] . PHP_EOL;
            echo '夏令時時區縮寫：' . $valueAry['timezone']['abbr_dst'] . PHP_EOL;
            echo '貨幣編碼：' . $valueAry['currency']['code']. PHP_EOL;
            echo '貨幣符號：' . $valueAry['currency']['symbol']. PHP_EOL;
            echo '貨幣名稱：' . $valueAry['currency']['name']. PHP_EOL;
        }
    }

    /**
     * Get currencies.
     *
     * @return Response
     */
    public function getCurrencies()
    {
        $currenciesAry = $this->marketstackService->makeHttpRequest('currencies', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($currenciesAry['data'] as $valueAry) {
            echo '編碼：' . $valueAry['code'] . PHP_EOL;
            echo '符號：' . $valueAry['symbol'] . PHP_EOL;
            echo '名稱：' . $valueAry['name'] . PHP_EOL;
        }
    }

    /**
     * Get timezones.
     *
     * @return Response
     */
    public function getTimezones()
    {
        $timezonesAry = $this->marketstackService->makeHttpRequest('timezones', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($timezonesAry['data'] as $valueAry) {
            echo '名稱：' . $valueAry['timezone'] . PHP_EOL;
            echo '縮寫：' . $valueAry['abbr'] . PHP_EOL;
            echo '夏令時時區縮寫：' . $valueAry['abbr_dst'] . PHP_EOL;
        }
    }
}
