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
