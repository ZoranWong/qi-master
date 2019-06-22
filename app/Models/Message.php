<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Message.
 *
 * @property int $id
 * @property int $memberId 会员ID
 * @property string $memberType 会员类型 user/master
 * @property string $title 标题
 * @property string $type 消息类型
 * @property string $content 内容
 * @property bool $status 状态 0->未读 1->已读
 * @property \Illuminate\Support\Carbon|null $createdAt
 * @property \Illuminate\Support\Carbon|null $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMemberType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'member_type', 'title', 'type', 'content'];

    protected $casts = [
        'status' => 'boolean'
    ];

    const STATUS_READ = 1;
    const STATUS_NEW = 0;
}
