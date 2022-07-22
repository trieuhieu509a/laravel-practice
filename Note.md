Eloquent
BlogPosts::all();
BlogPosts::find(1);
BlogPosts::find([1,2,3]);
BlogPosts::findOrFail(2);

$post = new BlogPosts();
...
$post->save();

Query builder
User::factory()->count(5)->create();
User::where('id', '>=', 2)->orderBy('id', 'desc')->get();

BlogPost::orderBy('created_at', 'desc')->take(5)->get()

composer require laravel/ui
php artisan ui bootstrap
php artisan ui:controllers

sudo npm install --global cross-env
npm install (--no-bin-links)
npm run dev
npm install sass-loader@10.1.1 --no-bin-links

php artisan cache:clear
php artisan make:test HomeTest
php artisan make:test PostTest

# One to One relationship
**Assigning relationship**
php artisan tinker

    Case 1:
    $author = new Author();
    $author->save();
    $profile = new Profile();
    $author->profile()->save($profile);

    Case 2:
    $author = Author::create();
    $profile = new Profile();
    $profile->author()->associate($author)->save();

    Case 3:
    $profile = new Profile();
    $author = Author::create();
    $profile->author_id = $author->id;
    $profile->save();

**One to One Assigning relationship**
php artisan tinker

    Lazy load 1:
    $author = Author::find(1);
    $author->profile

    Lazy load 2:
    $profile = Profile::find(3);
    $profile->author

    Eage load 1:
    $author = Author::with('profile')->whereKey(1);
    $author = Author::with('profile')->whereKey(1)->first();

    Eage load 2 miltyple related entities:
    $author = Author::with(['profile', 'comments'])->whereKey(1)->first();

# One to many relationship
**Generate model**

php artisan make:model Comment -m

```
    // function name is blogPost ( camel case , laravel will look for blog_post_id
    // function name is post ( camel case , laravel will look for post_id
    public function blogPost()
    {
        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
        return $this->belongsTo('App\Models\BlogPost');

    }
```
**Add data**
case 1
$comment = new Comment();
$comment->content = 'comment 1';
$blog->comments()->save($comment);

case 2
$comment2 = new Comment();
$comment2->content = 'comment 2';
$comment2->blogPost()->associate($blog)->save();

case 3
$comment3 = new Comment();
$comment3->content = 'comment 3';
$comment3->blog_post_id = $blog->id;
$comment3->save();

case 4 save many
$comment5 = new Comment();
$comment5->content = 'comment 5';
$comment4 = new Comment();
$comment4->content = 'comment 4';
$blog->comments()->saveMany([$comment4, $comment5]);

**Fetch data**

Eage load
BlogPost::with('comments')->get();
BlogPost::all();

Lazyload
Case 1:
$post = BlogPost::find(1);
$post->comment
Case 2:
$comment = Comment::find(1);
$comment->blogPost;

# Querying relationship existence
BlogPost::has('comments')->get();

$comment = new Comment();
$comment->content = 'abc';
$comment->blog_post_id = 3;
$comment->save();

**fetch all blog post that have at least 2 comment**

BlogPost::has('comments', '>=', 2)->get();

**fetch all blog post that comment that have content contain 'abc'**
BlogPost::whereHas('comments', function ($query) {
    $query->where('content', 'like', '%abc%');
})->get();

# Querying relationship absence
BlogPost::doesntHave('comments')->get();

BlogPost::whereDoesntHave('comments', function ($query) {
$query->where('content', 'like', '%abc%');
})->get();

# Counting reladted models

$post = BlogPost::withCount('comments')->get();
echo $post->comments_count;

BlogPost::withCount(['comments', 'comments as new_comments' => function ($query) {
    $query->where('created_at', '>=', '2022-07-13 15:51:45');
}])->get();

# Models factory introduction [https://laravel.com/docs/8.x/database-testing#persisting-models](https://laravel.com/docs/8.x/database-testing#persisting-models)

php artisan make:factory CommentFactory --model=Comment

php artisan tinker
Comment::factory()->count(3)->create(['blog_post_id' => 2])

# Model factory callbacks [https://laravel.com/docs/8.x/database-testing#factory-callbacks](https://laravel.com/docs/8.x/database-testing#factory-callbacks)
php artisan make:factory AuthorFactory
php artisan make:factory ProfileFactory

public function configure()
{
    return $this->afterCreating(function (Author $author) {
        $author->profile()->save(Profile::factory()->make());
    });
}

# Authentication
**IMPORTANT: Laravel 7 and Laravel 8 Changes**
composer require laravel/ui
php artisan ui:controllers

# Guest Middleware 
$this->middleware('guest')->except('logout');
'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
return redirect(RouteServiceProvider::HOME);

# Csrf
VerifyCsrfToken
Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
session storage in : storage/framework/sessions

# Seeding
php artisan make:migration add_user_to_blog_posts_table

**For table already have record exist**
$table->unsignedBigInteger('user_id')->default(0); or $table->unsignedInteger('user_id')->nullable()

**rollback all migration then run them again**
php artisan migrate:refresh
php artisan migrate:refresh --seed

**Generate seeding file**
php artisan make:seeder UsersTableSeeder
php artisan make:seeder BlogPostsTableSeeder
php artisan make:seeder CommentsTableSeeder

**Load all seeder in database**
php artisan db:seed
or run individual seeder class
php artisan db:seed --class=UsersTableSeeder

BlogPost::factory(50)->create()
BlogPost::factory(50)->make() : make not save immediately

composer dump-autoload : run after create any seeder class

**Seeder interactive**
abstract class Seeder
 * 
 * @var \Illuminate\Console\Command
 */
protected $command;
 * 
`
if ($this->command->confirm('Do you want to refresh the database?')) {

$this->command->call('migrate:refresh');
$this->command->info('Database was refreshed');
}
`
then run :
php artisan db:seed
or
php artisan db:seed -n : use default paramater value
