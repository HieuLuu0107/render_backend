<?php

namespace App\Services;

use App\Models\Borrow;
use App\Models\Notification;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BookBorrowed;
use App\Mail\BookReserved;
use App\Mail\BookAvailableNotification;
use App\Models\BookReservation;
use App\Mail\BookReservedNotification;

class NotificationService
{
    public function notifySubscriptionExpiring(Subscription $subscription)
    {
        // Tạo thông báo trong app
        Notification::create([
            'user_id' => $subscription->user_id,
            'type' => 'subscription_expiring',
            'title' => 'Gói thành viên sắp hết hạn',
            'content' => "Gói {$subscription->package->name} của bạn sẽ hết hạn vào ngày " . 
                        Carbon::parse($subscription->end_date)->format('d/m/Y'),
            'data' => [
                'subscription_id' => $subscription->id,
                'package_name' => $subscription->package->name,
                'end_date' => $subscription->end_date
            ]
        ]);

        // Gửi email
        Mail::to($subscription->user->email)->send(new \App\Mail\SubscriptionExpiring($subscription));
    }

    public function notifySubscriptionCreated(Subscription $subscription)
    {
        Notification::create([
            'user_id' => $subscription->user_id,
            'type' => 'subscription_created',
            'title' => 'Đăng ký gói thành công',
            'content' => "Bạn đã đăng ký thành công gói {$subscription->package->name}",
            'data' => [
                'subscription_id' => $subscription->id,
                'package_name' => $subscription->package->name
            ]
        ]);

        Mail::to($subscription->user->email)->send(new \App\Mail\SubscriptionCreated($subscription));
    }

    public function notifyPaymentSuccess(Subscription $subscription)
    {
        Notification::create([
            'user_id' => $subscription->user_id,
            'type' => 'payment_success',
            'title' => 'Thanh toán thành công',
            'content' => "Thanh toán gói {$subscription->package->name} thành công",
            'data' => [
                'subscription_id' => $subscription->id,
                'amount' => $subscription->amount_paid
            ]
        ]);

        Mail::to($subscription->user->email)->send(new \App\Mail\PaymentSuccess($subscription));
    }

    public function notifyBookBorrowed(Borrow $borrow)
    {
        try {
            // Tạo thông báo
            Notification::create([
                'user_id' => $borrow->user_id,
                'type' => 'book_borrowed',
                'title' => 'Mượn sách thành công',
                'content' => "Bạn đã mượn sách \"{$borrow->book->title}\" thành công",
                'data' => [
                    'borrow_id' => $borrow->id,
                    'book_title' => $borrow->book->title,
                    'due_date' => $borrow->due_date
                ]
            ]);

            // Gửi email (đặt trong try-catch riêng nếu cần)
            try {
                Mail::to($borrow->user->email)->send(new BookBorrowed($borrow));
            } catch (\Exception $e) {
                Log::error('Error sending borrow email: ' . $e->getMessage());
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Error creating borrow notification: ' . $e->getMessage());
            return false; // Trả về false thay vì throw exception
        }
    }

    public function notifyBookReserved(BookReservation $reservation)
    {
        try {
            // Tạo notification trong database
            $notification = Notification::create([
                'user_id' => $reservation->user_id,
                'type' => 'book_reserved',
                'title' => 'Đặt trước sách thành công',
                'content' => 'Bạn đã đặt trước thành công sách "' . $reservation->book->title . '"'
            ]);

            // Gửi email
            Mail::to($reservation->user->email)
                ->send(new BookReservedNotification($reservation));

            try {
                // Broadcast event
                event(new \App\Events\NewNotification($notification));
            } catch (\Exception $e) {
                Log::error('Broadcasting error:', [
                    'error' => $e->getMessage()
                ]);
                // Không throw exception khi broadcast lỗi
            }

        } catch (\Exception $e) {
            Log::error('Error in NotificationService::notifyBookReserved', [
                'error' => $e->getMessage(),
                'reservation_id' => $reservation->id
            ]);
            // Không throw exception để tiếp tục flow
        }
    }

    public function notifyBookAvailable($reservation)
    {
        try {
            // Tạo thông báo trong hệ thống
            Notification::create([
                'user_id' => $reservation->user_id,
                'type' => 'book_available',
                'title' => 'Sách đã có sẵn',
                'content' => "Sách \"{$reservation->book->title}\" bạn đặt trước đã có sẵn",
                'data' => [
                    'reservation_id' => $reservation->id,
                    'book_id' => $reservation->book_id,
                    'book_title' => $reservation->book->title
                ]
            ]);

            // Gửi email
            Mail::to($reservation->user->email)
                ->send(new BookAvailableNotification($reservation));

            // Cập nhật trạng thái đặt trước
            $reservation->update([
                'status' => 'available',
                'available_until' => now()->addHours(48)
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Error sending book available notification: ' . $e->getMessage());
            return false;
        }
    }
} 