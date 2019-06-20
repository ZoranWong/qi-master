<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\Message;
use App\Models\User;
use App\Repositories\MessageRepository;
use App\Transformers\MessageTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;

class MessageController extends Controller
{
    protected $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 消息列表
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->withCount(['newMessages']);

        $paginator = $user->messages()->paginate(PAGE_SIZE);

        return $this->response->paginator($paginator, new MessageTransformer)
            ->addMeta('new_messages_count', $user->newMessagesCount);
    }

    /**
     * 阅读消息
     * @param Request $request
     * @return Response
     */
    public function read(Request $request)
    {
        $messageIds = $request->input('message_ids', []);

        Message::whereIn('id', $messageIds)->update(['status' => Message::STATUS_READ]);

        return $this->response->noContent();
    }

    /**
     * 删除消息
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $messageIds = $request->input('message_ids', []);

        Message::whereIn('id', $messageIds)->delete();

        return $this->response->noContent();
    }
}
