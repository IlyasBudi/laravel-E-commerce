<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use App\Models\ProductTransaction;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.midtrans.server_key');
        Config::$isProduction = config('midtrans.midtrans.is_production');
        Config::$isSanitized = config('midtrans.midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.midtrans.is_3ds');
    }

    /**
     * Handle Midtrans notification.
     */
    public function notification(Request $request)
    {
        // Ambil notifikasi dari Midtrans
        $notification = new Notification();

        // Dapatkan status transaksi
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Cari transaksi berdasarkan order ID
        $transaction = ProductTransaction::find($orderId);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found',
            ], 404);
        }

        // Log setiap status transaksi untuk mempermudah debugging
        Log::info('Midtrans notification received', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'payment_type' => $paymentType,
            'fraud_status' => $fraudStatus,
        ]);

        // Proses sesuai dengan status transaksi dari Midtrans
        if ($transactionStatus == 'capture') {
            // Untuk payment card
            if ($fraudStatus == 'challenge') {
                // Transaksi masuk fraud challenge
                $transaction->update(['is_paid' => false]);
                Log::info('Transaction is challenged by fraud detection system', ['order_id' => $orderId]);
            } else if ($fraudStatus == 'accept') {
                // Transaksi sukses
                $transaction->update(['is_paid' => true]);
                Log::info('Transaction success', ['order_id' => $orderId]);
            }
        } else if ($transactionStatus == 'settlement') {
            // Transaksi selesai, update sebagai dibayar
            $transaction->update(['is_paid' => true]);
            Log::info('Transaction settled', ['order_id' => $orderId]);
        } else if ($transactionStatus == 'pending') {
            // Transaksi pending
            $transaction->update(['is_paid' => false]);
            Log::info('Transaction is pending', ['order_id' => $orderId]);
        } else if ($transactionStatus == 'deny') {
            // Transaksi ditolak
            $transaction->update(['is_paid' => false]);
            Log::info('Transaction denied', ['order_id' => $orderId]);
        } else if ($transactionStatus == 'expire') {
            // Transaksi expired
            $transaction->update(['is_paid' => false]);
            Log::info('Transaction expired', ['order_id' => $orderId]);
        } else if ($transactionStatus == 'cancel') {
            // Transaksi dibatalkan
            $transaction->update(['is_paid' => false]);
            Log::info('Transaction canceled', ['order_id' => $orderId]);
        }

        return response()->json([
            'message' => 'Notification processed successfully',
        ], 200);
    }
}
