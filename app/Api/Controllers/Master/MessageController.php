<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Models\User;
use App\Repositories\MessageRepository;
use App\Transformers\MessageTransformer;

class MessageController extends Controller
{
    protected $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $user = $user->withCount(['newMessages', 'messages'])->find($user->id);

        $paginator = $user->messages()->paginate(PAGE_SIZE);

        return $this->response->paginator($paginator, new MessageTransformer)
            ->addMeta('new_messages_count', $user->newMessagesCount);
    }

}
