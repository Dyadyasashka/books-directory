<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            'Стив Макконнелл',
            'Михаил Фленов',
            'Мэтт Стаффер',
            'Дэвид Скляр',
            'Адам Трахтенберг',
            'Бэрон Шварц',
            'Вадим Ткаченко',
            'Петр Зайцев',
            'Ральф Джонсон',
            'Джон Влиссидес',
            'Ричард Хелм',
            'Эрих Гамма'
        ];

        foreach ($authors as $author) {
            Author::create(['name' => $author]);
        }
    }
}
