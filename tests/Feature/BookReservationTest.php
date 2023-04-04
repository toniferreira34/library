<?php

namespace Tests\Feature;


use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertCount;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books',[
           'title'=> 'cool book title',
           'author' => 'toni',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {

        $response = $this->post('/books',[
            'title'=> '',
            'author' => 'toni',
        ]);

        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_author_is_required()
    {

        $response = $this->post('/books',[
            'title'=> 'a coll',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }


    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();
        $this->post('/books',[
            'title'=> 'a coll',
            'author' => 'toni',
        ]);

        $book = Book::first();


        $response = $this->patch('/books/' . $book->id,[
            'title' => 'new_title',
            'author' => 'new_author',
        ]);
        $this->assertEquals('new_title', Book::first()->title);
        $this->assertEquals('new_author', Book::first()->author);
    }
}
