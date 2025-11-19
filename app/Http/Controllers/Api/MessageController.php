<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Tag(
 *     name="Messages",
 *     description="API Endpoints for Messages Management"
 * )
 */

class MessageController extends Controller
{
    /**
     * Get user inbox messages
     * 
     * @OA\Get(
     *     path="/api/messages/inbox",
     *     tags={"Messages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Messages retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Messages retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="sender_id", type="integer", example=2),
     *                     @OA\Property(property="recipient_id", type="integer", example=3),
     *                     @OA\Property(property="subject", type="string", example="Welcome Message"),
     *                     @OA\Property(
     *                         property="body",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="index", type="integer", example=0),
     *                             @OA\Property(property="text", type="string", example="This is message text")
     *                         )
     *                     ),
     *                     @OA\Property(property="is_read", type="boolean", example=false),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                     @OA\Property(
     *                         property="attachments",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="file_name", type="string", example="document.pdf"),
     *                             @OA\Property(property="file_path", type="string", example="attachments/document.pdf"),
     *                             @OA\Property(property="file_size", type="integer", example=1024),
     *                             @OA\Property(property="mime_type", type="string", example="application/pdf"),
     *                             @OA\Property(property="created_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="to", type="integer", example=15),
     *                 @OA\Property(property="total", type="integer", example=50),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="last_page", type="integer", example=4)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */

    public function inbox()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $messages = $user->receivedMessages()->with('attachments')->latest()->paginate(10);
            $unreadCount = $user->receivedMessages()->where('is_read', 0)->count();

            if ($messages->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No messages found',
                    'data' => [],
                    'unread_count' => 0
                ], 404);
            }

            $messages->getCollection()->transform(function ($message) {
                $lines = [];

                $plainText = strip_tags($message->body);
                $lines = array_filter(explode("\n", $plainText), function ($line) {
                    return trim($line) !== '';
                });

                if (empty($lines)) {
                    $lines = [trim($plainText)];
                }

                $message->body = array_values($lines);
                return $message;
            });

            return response()->json([
                'data' => $messages,
                'unread_count' => $unreadCount,
                'status' => 'success',
                'code' => 200,
                'message' => 'Messages retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error' . $e
            ], 500);
        }
    }

    /**
     * Get user sent messages
     * 
     * @OA\Get(
     *     path="/api/messages/sent",
     *     tags={"Messages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Messages retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Messages retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="sender_id", type="integer", example=2),
     *                     @OA\Property(property="recipient_id", type="integer", example=3),
     *                     @OA\Property(property="subject", type="string", example="Welcome Message"),
     *                     @OA\Property(
     *                         property="body",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="index", type="integer", example=0),
     *                             @OA\Property(property="text", type="string", example="This is message text")
     *                         )
     *                     ),
     *                     @OA\Property(property="is_read", type="boolean", example=false),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                     @OA\Property(
     *                         property="attachments",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="file_name", type="string", example="document.pdf"),
     *                             @OA\Property(property="file_path", type="string", example="attachments/document.pdf"),
     *                             @OA\Property(property="file_size", type="integer", example=1024),
     *                             @OA\Property(property="mime_type", type="string", example="application/pdf"),
     *                             @OA\Property(property="created_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="to", type="integer", example=15),
     *                 @OA\Property(property="total", type="integer", example=50),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="last_page", type="integer", example=4)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */

    public function sent()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $messages = $user->sentMessages()->with('attachments')->latest()->paginate(10);
            $unreadCount = $user->sentMessages()->where('is_read', 0)->count();

            if ($messages->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No messages found',
                    'data' => [],
                    'unread_count' => 0
                ], 404);
            }

            return response()->json([
                'data' => $messages,
                'unread_count' => $unreadCount,
                'status' => 'success',
                'code' => 200,
                'message' => 'Messages retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error' . $e
            ], 500);
        }
    }

    /**
     * Send a new message
     * 
     * @OA\Post(
     *     path="/api/messages",
     *     tags={"Messages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"recipient_id", "subject", "body"},
     *                 @OA\Property(
     *                     property="recipient_id",
     *                     type="array",
     *                     description="Array of recipient IDs or 'all_admins'",
     *                     @OA\Items(
     *                         type="string",
     *                         example="all_admins"
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="trainer_id",
     *                     type="array",
     *                     description="Array of trainer IDs to include (optional)",
     *                     @OA\Items(
     *                         type="integer",
     *                         example=25
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="subject",
     *                     type="string",
     *                     description="Message subject",
     *                     maxLength=255,
     *                     example="Welcome Message"
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     description="Message body",
     *                     example="This is the message content"
     *                 ),
     *                 @OA\Property(
     *                     property="attachments[]",
     *                     type="array",
     *                     description="Message attachments",
     *                     @OA\Items(
     *                         type="string",
     *                         format="binary"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Message sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Message sent successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="total_recipients", type="integer", example=5),
     *                 @OA\Property(
     *                     property="recipients_breakdown",
     *                     type="object",
     *                     @OA\Property(property="students", type="integer", example=2),
     *                     @OA\Property(property="trainers", type="integer", example=2),
     *                     @OA\Property(property="admins", type="integer", example=1)
     *                 ),
     *                 @OA\Property(
     *                     property="sent_messages",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="message_id", type="integer", example=45),
     *                         @OA\Property(property="recipient_id", type="string", example="10"),
     *                         @OA\Property(property="recipient_email", type="string", example="user@example.com"),
     *                         @OA\Property(property="recipient_name", type="string", example="John Doe"),
     *                         @OA\Property(property="recipient_type", type="string", example="Student"),
     *                         @OA\Property(property="is_trainer", type="boolean", example=false)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=422),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="recipient_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="The recipient id field is required.")
     *                 ),
     *                 @OA\Property(
     *                     property="trainer_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="The selected trainer id is not a valid trainer.")
     *                 ),
     *                 @OA\Property(
     *                     property="subject",
     *                     type="array",
     *                     @OA\Items(type="string", example="The subject field is required.")
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="array",
     *                     @OA\Items(type="string", example="The body field is required.")
     *                 ),
     *                 @OA\Property(
     *                     property="attachments",
     *                     type="array",
     *                     @OA\Items(type="string", example="The total size of all attachments must not be greater than 5MB.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Message sending failed"),
     *             @OA\Property(property="error", type="string", example="Error details here")
     *         )
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
            if (is_string($request->recipient_id)) {
                $recipientIds = array_map('trim', explode(',', $request->recipient_id));
                $request->merge(['recipient_id' => $recipientIds]);
            }

            if ($request->has('trainer_id') && is_string($request->trainer_id)) {
                $trainerIds = array_map('trim', explode(',', $request->trainer_id));
                $request->merge(['trainer_id' => $trainerIds]);
            }

            if ($request->has('trainer_id') && is_numeric($request->trainer_id)) {
                $request->merge(['trainer_id' => [(string)$request->trainer_id]]);
            }

            $validator = Validator::make($request->all(), [
                'recipient_id' => 'required|array',
                'recipient_id.*' => ['string', function ($attribute, $value, $fail) {
                    if ($value !== 'all_admins' && !User::where('id', $value)->exists()) {
                        $fail('Invalid recipient selected.');
                    }
                }],
                'trainer_id' => 'nullable|array',
                'trainer_id.*' => ['exists:users,id', function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if ($user && !$user->hasRole('Trainer')) {
                        $fail('The selected trainer id is not a valid trainer.');
                    }
                }],
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $this->validateCombinedAttachmentSize($request->file('attachments'));

            $finalRecipients = collect();

            foreach ($request->recipient_id as $recipientId) {
                if ($recipientId === 'all_admins') {
                    $admins = User::role(['Admin', 'Super Admin'])
                        ->whereNotIn('id', [4, 5])
                        ->pluck('id');

                    $finalRecipients = $finalRecipients->merge($admins);
                } else {
                    $finalRecipients->push($recipientId);

                    $user = User::with('cohorts')->find($recipientId);
                    if ($user && $user->hasRole('Student')) {
                        $trainerIds = $user->cohorts->pluck('trainer_id')->filter()->unique();

                        if ($trainerIds->isNotEmpty()) {
                            $finalRecipients = $finalRecipients->merge($trainerIds);
                        }
                    }
                }
            }

            if ($request->has('trainer_id') && is_array($request->trainer_id)) {
                foreach ($request->trainer_id as $trainerId) {
                    $trainer = User::find($trainerId);
                    if ($trainer && $trainer->hasRole('Trainer')) {
                        $finalRecipients->push($trainerId);
                    } else {
                        \Log::warning('Invalid Trainer ID', ['trainer_id' => $trainerId]);
                    }
                }
            }

            $finalRecipients = $finalRecipients->unique();

            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = $file->store('attachments', 'public');
                    $attachments[] = [
                        'stored' => $filename,
                        'full_path' => storage_path('app/public/' . $filename)
                    ];
                }
            }

            $sentMessages = [];

            foreach ($finalRecipients as $recipientId) {
                $messageModel = Message::create([
                    'sender_id' => auth()->id(),
                    'recipient_id' => $recipientId,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ]);

                foreach ($attachments as $file) {
                    $messageModel->attachments()->create(['filename' => $file['stored']]);
                }

                $recipient_user = User::find($recipientId);

                if (!$recipient_user) {
                    \Log::warning('Recipient User Not Found', ['recipient_id' => $recipientId]);
                    continue;
                }


                try {
                    Mail::to($recipient_user->email)->send(new MessageSent([
                        'subject' => $request->subject,
                        'body' => $request->body,
                        'attachments' => collect($attachments)->pluck('full_path')->toArray(),
                    ]));
                } catch (\Swift_TransportException $e) {
                    if (strpos($e->getMessage(), '503') === false) {
                        throw $e;
                    }
                }

                $sentMessages[] = [
                    'message_id' => $messageModel->id,
                    'recipient_id' => $recipientId,
                    'recipient_email' => $recipient_user->email,
                    'recipient_name' => $recipient_user->name,
                    'recipient_type' => $recipient_user->getRoleNames()->first(),
                    'is_trainer' => $recipient_user->hasRole('Trainer')
                ];
            }

            $response = [
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => [
                    'total_recipients' => $finalRecipients->count(),
                    'sent_messages' => $sentMessages
                ]
            ];
            return response()->json($response, 201);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Message sending failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    protected function validateCombinedAttachmentSize($attachments)
    {
        if ($attachments) {
            $totalSize = 0;

            foreach ($attachments as $attachment) {
                $totalSize += $attachment->getSize();
            }

            if ($totalSize > 5 * 1024 * 1024) {
                throw ValidationException::withMessages([
                    'attachments' => ['The total size of all attachments must not be greater than 5MB.'],
                ]);
            }
        }
    }
}
