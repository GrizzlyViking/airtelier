<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Event;
use App\Models\Offer;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function build_an_article()
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $this->assertTrue($article instanceof Article);
        $this->assertDatabaseHas('articles', [
			'slug' => $article->slug,
			'title' => $article->title,
		]);
    }

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function build_article_and_attach_elements()
    {
        $user =  factory(User::class)->create();
        /** @var Article $article */
        $article = factory(Article::class)->create([
            'author_id' => $user->id
        ]);
        /** @var Offer $offer */
        $offer = factory(Offer::class)->create([
            'owner_id' => $user->id
        ]);

        $article->offers()->attach($offer);

        $offer = factory(Offer::class)->create([
            'owner_id' => $user->id
        ]);
        $article->offers()->attach($offer);

        /** @var Event $event */
        $event = factory(Event::class)->create([
            'owner_id' => $user->id
        ]);
        $article->events()->attach($event);
        $event = factory(Event::class)->create([
            'owner_id' => $user->id
        ]);
        $article->events()->attach($event);

        $this->assertEquals(2,$article->offers->count());
        $this->assertDatabaseHas('offers', ['title' => $offer->title]);
        $this->assertEquals(2,$article->events->count());
        $this->assertDatabaseHas('events', ['title' => $event->title]);
        $this->assertContainsOnly(Event::class, $article->events);
        $this->assertContainsOnly(Offer::class, $article->offers);
    }
}
