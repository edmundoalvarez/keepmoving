<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property int $news_id
 * @property string $title
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @property string $lead
 * @property string|null $image
 * @property string|null $image_small
 * @property string|null $image_description
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImageDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImageSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereLead($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $table = "news";

    protected $primaryKey = "news_id";

    protected $fillable = ['title', 'lead', 'text', 'image','image_small', 'image_description'];

    public static $rules = [
        'title' => 'required|max:40',
        'lead' => 'required|max:100|min:40',
        'text' => 'required|min:100',
        'image' => 'nullable',
        'image_small' => 'nullable',
        'image_description' => 'nullable',
    ];

    public static $errorMessages = [
        'title.required' => 'El título es obligatorio',
        'title.max' => 'El título debe tener como máximo :max caracteres',
        'lead.required' => 'La bajada es obligatoria',
        'lead.min' => 'La bajada tener al menos :min caracteres',
        'lead.max' => 'La bajada debe tener como máximo :max caracteres',
        'text.required' => 'El texto es obligatorio',
        'text.min' => 'El texto debe tener al menos :min caracteres',
    ];
}
