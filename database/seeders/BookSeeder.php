<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['title' => 'Совершенный код', 'authors' => ['Стив Макконнелл']],
            ['title' => 'PHP глазами хакера', 'authors' => ['Михаил Фленов']],
            ['title' => 'Laravel. Полное руководство', 'authors' => ['Мэтт Стаффер']],
            ['title' => 'PHP. Рецепты программирования', 'authors' => ['Дэвид Скляр', 'Адам Трахтенберг']],
            ['title' => 'MySQL по максимуму', 'authors' => ['Бэрон Шварц', 'Вадим Ткаченко', 'Петр Зайцев']],
            ['title' => 'Паттерны объектно-ориентированного проектирования', 'authors' => ['Ральф Джонсон', 'Джон Влиссидес', 'Ричард Хелм', 'Эрих Гамма']],
        ];

        foreach ($books as $bookData) {
            $book = Book::create(['title' => $bookData['title']]);
            $authors = Author::whereIn('name', $bookData['authors'])->get();
            $book->authors()->attach($authors);
        }
    }
}
