<?php

namespace App\Models;

use App\Traits\SlugTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 *
 * @package App\Models
 *
 * @property int        $id
 * @property int        $author_id
 * @property string     $title
 * @property string     $sub_title
 * @property string     $resume
 * @property string     $content
 * @property Carbon     $publish
 * @property Carbon     $un_publish
 * @property Collection $offers
 * @property Collection $events
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property Carbon     $deleted_at
 */
class Article extends Model
{
    use SoftDeletes, SlugTrait;

    protected $dates = [
        'publish',
        'un_publish',
    ];

    protected $fillable = [
        'author_id',
        'title',
        'sub_title',
        'resume',
        'content',
        'publish',
        'un_publish',
    ];

    public function author(): Relation
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function offers(): Relation
    {
        return $this->morphedByMany(
            Offer::class,
            'element',
            'articles_elements');
    }

    public function events(): Relation
    {
        return $this->morphedByMany(
            Event::class,
            'element',
            'articles_elements'
        );
    }
}
