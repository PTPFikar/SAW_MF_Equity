<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Criteria
 *
 * @property int $id
 * @property string $name
 * @property string $criteriaName
 * @property string $attribute
 * @property int $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereCriteriaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Criteria whereWeight($value)
 */
	class Criteria extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Products
 *
 * @property int $id
 * @property string $ISIN
 * @property string $productName
 * @property string $sharpRatio
 * @property int $AUM
 * @property int $deviden
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereAUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDeviden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereISIN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSharpRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Result
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result query()
 */
	class Result extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UploadProducts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UploadProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadProducts query()
 */
	class UploadProducts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

