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
 * App\Models\Certificate
 *
 * @property int $id
 * @property string $name
 * @property string $company_name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read int|null $profiles_count
 * @method static \Database\Factories\CertificateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereUpdatedAt($value)
 */
	class Certificate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $photo
 * @property int $post_id
 * @property int $profile_id
 * @property int|null $comment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $likes
 * @property-read int|null $likes_count
 * @property-read Comment|null $parentComment
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $replies
 * @property-read int|null $replies_count
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $street
 * @property string|null $logo
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @property-read int|null $certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Experience[] $experiences
 * @property-read int|null $experiences_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $managementProfiles
 * @property-read int|null $management_profiles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompanyPhone[] $phones
 * @property-read int|null $phones_count
 * @method static \Database\Factories\CompanyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWebsite($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CompanyPhone
 *
 * @property int $id
 * @property string $phone
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @method static \Database\Factories\CompanyPhoneFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPhone whereUpdatedAt($value)
 */
	class CompanyPhone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Experience
 *
 * @property int $id
 * @property string $start
 * @property string $end
 * @property string $position
 * @property string $company_name
 * @property int|null $company_id
 * @property int $profile_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Profile $profile
 * @method static \Database\Factories\ExperienceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereUpdatedAt($value)
 */
	class Experience extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $photo
 * @property int $profile_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $nickname
 * @property string|null $birthdate
 * @property string|null $about
 * @property string|null $avatar
 * @property string|null $background_photo
 * @property string|null $website
 * @property string|null $country
 * @property string|null $city
 * @property string|null $state
 * @property string|null $street
 * @property string|null $university
 * @property string|null $degree
 * @property string|null $study_type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Certificate[] $certificates
 * @property-read int|null $certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $commentsLikes
 * @property-read int|null $comments_likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Profile[] $connectionsFrom
 * @property-read int|null $connections_from_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Profile[] $connectionsTo
 * @property-read int|null $connections_to_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Experience[] $experiences
 * @property-read int|null $experiences_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Profile[] $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Profile[] $followings
 * @property-read int|null $followings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $managementCompanies
 * @property-read int|null $management_companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfilePhone[] $phones
 * @property-read int|null $phones_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $postsLikes
 * @property-read int|null $posts_likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Skill[] $skills
 * @property-read int|null $skills_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBackgroundPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStudyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUniversity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereWebsite($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProfilePhone
 *
 * @property int $id
 * @property string $phone
 * @property int $profile_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Profile $profile
 * @method static \Database\Factories\ProfilePhoneFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilePhone whereUpdatedAt($value)
 */
	class ProfilePhone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Skill
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read int|null $profiles_count
 * @method static \Database\Factories\SkillFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereUpdatedAt($value)
 */
	class Skill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

