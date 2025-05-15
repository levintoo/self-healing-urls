<?php

namespace Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Levintoo\SelfHealingUrls\Concerns\HasSelfHealingUrls;

class Post extends Model
{
    use HasSelfHealingUrls;

    protected $slug = 'title';
}
