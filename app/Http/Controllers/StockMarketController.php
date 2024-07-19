<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Marketstack\MarketstackConnector;
use Carbon\Carbon;

class StockMarketController extends Controller
{
    private $marketstackConnector;

    /**
     * Instantiate a new StockMarketController instance.
     *
     * @param MarketstackConnector $marketstackConnector
     *
     * @return Response
     */
    public function __construct(MarketstackConnector $marketstackConnector)
    {
        $this->marketstackConnector = $marketstackConnector;
    }

    /**
     * Get end of day.
     *
     * @return Response
     */
    public function getEndOfDay()
    {
        $endOfFayAry = $this->marketstackConnector->makeHttpRequest('eod', [
           // 'date_from' => Carbon::today()->format(Y-m-d),
           // 'date_to'   => Carbon::today()->format(Y-m-d),
           'limit'     => 1,
           'offset'    => 0,
           'sort'      => 'DESC',
           'symbols'   => 'AAPL'
        ]);
        foreach ($endOfFayAry['data'] as $valueAry) {
            echo __('Original opening price:') . $valueAry['open'] . PHP_EOL;
            echo __('Original high price:') . $valueAry['high'] . PHP_EOL;
            echo __('Original low price:') . $valueAry['low'] . PHP_EOL;
            echo __('Original closing price:') . $valueAry['close'] . PHP_EOL;
            echo __('Original trading volume:') . $valueAry['volume'] . PHP_EOL;
            echo __('Adjusted high price:') . $valueAry['adj_high'] . PHP_EOL;
            echo __('Adjusted low price:') . $valueAry['adj_low'] . PHP_EOL;
            echo __('Adjusted closing price:') . $valueAry['adj_close'] . PHP_EOL;
            echo __('Adjusted opening price:') . $valueAry['adj_open'] . PHP_EOL;
            echo __('Adjusted volume:') . $valueAry['adj_volume'] . PHP_EOL;
            echo __('Split factor:') . $valueAry['split_factor'] . PHP_EOL;
            echo __('Ticker symbol:') . $valueAry['symbol'] . PHP_EOL;
            echo __('Exchange MIC identification:') . $valueAry['exchange'] . PHP_EOL;
            echo __('Date:') .  Carbon::parse($valueAry['date'])->setTimezone('Asia/Taipei')->format('Y-m-d H:i:s') . PHP_EOL;
        }
    }

    /**
     * Get intraday.
     *
     * @return Response
     */
    public function getIntraday()
    {
        $intradayAry = ($this->marketstackConnector->makeHttpRequest('intraday', [
            //'interval' => '1h',
            'limit'   => 1,
            'offset'  => 0,
            'sort'    => 'DESC',
            'symbols' => 'AAPL' // AAPL,MSFT
        ]));
        foreach ($intradayAry['data'] as $valueAry) {
            echo __('Original opening price:') . $valueAry['open'] . PHP_EOL;
            echo __('Original high price:') . $valueAry['high'] . PHP_EOL;
            echo __('Original low price:') . $valueAry['low'] . PHP_EOL;
            echo __('Original closing price:') . $valueAry['close'] . PHP_EOL;
            echo __('Last executed trade:') . $valueAry['last'] . PHP_EOL;
            echo __('Trading volume:') . $valueAry['volume'] . PHP_EOL;
            echo __('Ticker symbol:') . $valueAry['symbol'] . PHP_EOL;
            echo __('Exchange MIC identification:') . $valueAry['exchange'] . PHP_EOL;
            echo __('Date:') .  Carbon::parse($valueAry['date'])->setTimezone('Asia/Taipei')->format('Y-m-d H:i:s') . PHP_EOL;
        }
    }

    /**
     * Get tickers.
     *
     * @return Response
     */
    public function getTickers()
    {
        $tickersAry = $this->marketstackConnector->makeHttpRequest('tickers', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($tickersAry['data'] as $valueAry) {
            echo __('Name:') . $valueAry['name'] . PHP_EOL;
            echo __('Symbol:') . $valueAry['symbol'] . PHP_EOL;
            echo __('Has intraday:') . $valueAry['has_intraday'] . PHP_EOL;
            echo __('Has end-of-day:') . $valueAry['has_eod'] . PHP_EOL;
            echo __('Country:') . $valueAry['country'] . PHP_EOL;
            echo __('Name of the stock exchange:') . $valueAry['stock_exchange']['name'] . PHP_EOL;
            echo __('Acronym of the stock exchange:') . $valueAry['stock_exchange']['acronym'] . PHP_EOL;
            echo __('MIC identification of the stock exchange:') . $valueAry['stock_exchange']['mic'] . PHP_EOL;
            echo __('Country of the stock exchange:') . $valueAry['stock_exchange']['country']. PHP_EOL;
            echo __('3-letter country code of the stock exchange:') . $valueAry['stock_exchange']['country_code']. PHP_EOL;
            echo __('City of the stock exchange:') . $valueAry['stock_exchange']['city']. PHP_EOL;
            echo __('Website URL of the stock exchange:') . $valueAry['stock_exchange']['website']. PHP_EOL;
        }
    }

    /**
     * Get exchanges.
     *
     * @return Response
     */
    public function getExchanges()
    {
        $exchangesAry = $this->marketstackConnector->makeHttpRequest('exchanges', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($exchangesAry['data'] as $valueAry) {
            echo __('Name:') . $valueAry['name'] . PHP_EOL;
            echo __('Acronym:') . $valueAry['acronym'] . PHP_EOL;
            echo __('MIC identification:') . $valueAry['mic'] . PHP_EOL;
            echo __('Country:') . $valueAry['country'] . PHP_EOL;
            echo __('3-letter country code:') . $valueAry['country_code'] . PHP_EOL;
            echo __('Given city:') . $valueAry['city'] . PHP_EOL;
            echo __('Website URL:') . $valueAry['website'] . PHP_EOL;
            echo __('Timezone name:') . $valueAry['timezone']['timezone'] . PHP_EOL;
            echo __('Timezone abbreviation:') . $valueAry['timezone']['abbr'] . PHP_EOL;
            echo __('Summer time timezone abbreviation:') . $valueAry['timezone']['abbr_dst'] . PHP_EOL;
            echo __('3-letter code of the currency:') . $valueAry['currency']['code']. PHP_EOL;
            echo __('Text symbol of the currency:') . $valueAry['currency']['symbol']. PHP_EOL;
            echo __('Name of the currency:') . $valueAry['currency']['name']. PHP_EOL;
        }
    }

    /**
     * Get currencies.
     *
     * @return Response
     */
    public function getCurrencies()
    {
        $currenciesAry = $this->marketstackConnector->makeHttpRequest('currencies', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($currenciesAry['data'] as $valueAry) {
            echo __('3-letter code:') . $valueAry['code'] . PHP_EOL;
            echo __('Text symbol:') . $valueAry['symbol'] . PHP_EOL;
            echo __('Name:') . $valueAry['name'] . PHP_EOL;
        }
    }

    /**
     * Get timezones.
     *
     * @return Response
     */
    public function getTimezones()
    {
        $timezonesAry = $this->marketstackConnector->makeHttpRequest('timezones', [
           'limit'  => 1,
           'offset' => 0,
        ]);
        foreach ($timezonesAry['data'] as $valueAry) {
            echo __('Name:') . $valueAry['timezone'] . PHP_EOL;
            echo __('Abbreviation:') . $valueAry['abbr'] . PHP_EOL;
            echo __('Summer time abbreviation:') . $valueAry['abbr_dst'] . PHP_EOL;
        }
    }
}
