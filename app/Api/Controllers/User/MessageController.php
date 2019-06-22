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

        $user = $user->withCount(['newMessages', 'messages'])->find($user->id);

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
        $messageIds = $request->input('message_ids');

        if (is_null($messageIds)) {
            $this->response->errorBadRequest('缺少待阅读消息IDs参数');
        }

        /** @var User $user */
        $user = auth()->user();

        $query = $user->messages()->whereIn('id', $messageIds);

        if ($query->count() < count($messageIds)) {
            $this->response->errorBadRequest('待阅读消息中有不属于您的消息，禁止阅读');
        }

        $query->update(['status' => Message::STATUS_READ]);

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

        if (is_null($messageIds)) {
            $this->response->errorBadRequest('缺少待阅读消息IDs参数');
        }

        /** @var User $user */
        $user = auth()->user();

        $query = $user->messages()->whereIn('id', $messageIds);

        if ($query->count() < count($messageIds)) {
            $this->response->errorBadRequest('待阅读消息中有不属于您的消息，或者消息已删除，禁止删除');
        }

        $query->delete();

        return $this->response->noContent();
    }
}
