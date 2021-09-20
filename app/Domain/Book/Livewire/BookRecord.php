<?php

namespace App\Domain\Book\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class BookRecord extends Component
{


    public function deleteBook($book_id)
    {
        //dd($book_id);
        $response = Http::delete(route('books.destroy', ['book' => $book_id]));
        //dd($response->json()["status_code"]);
        if ( $response->json()["status_code"] === 204 ){
            flash()->overlay($response->json()["message"], "")->livewire($this);
            return;
        }
        flash()->overlay($response->json()["message"], "")->livewire($this);
    }


    public function render()
    {
        $response = Http::get(route('books.index', ['limit' => 10]));
        //dd($response->json());
        return view('book.book-record', ['data' => $response->json()["data"]])
            ->layoutData(['page_title' => "Book Records"]);
    }
}
