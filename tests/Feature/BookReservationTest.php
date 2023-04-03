<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertCount;

class BookReservationTest extends TestCase
{
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $respose = $this->post('/books',[
           'title'=> 'cool book title',
           'author' => 'toni'
        ]);

        $respose->assertOk();
        $this.assertCount(1, Book::all());
    }
}
