<?php

use App\Http\Controllers\StockMarketController;
use Illuminate\Support\Facades\Route;

Route::get('marketstack/eod/', [StockMarketController::class, 'getEndOfDay']);
Route::get('marketstack/intraday/', [StockMarketController::class, 'getIntraday']);
Route::get('marketstack/tickers/', [StockMarketController::class, 'getTickers']);
Route::get('marketstack/exchanges/', [StockMarketController::class, 'getExchanges']);
Route::get('marketstack/currencies/', [StockMarketController::class, 'getCurrencies']);
Route::get('marketstack/timezones/', [StockMarketController::class, 'getTimezones']);
