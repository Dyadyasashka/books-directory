<template>
    <div class="catalog">
        <h1 class="title">Каталог книг</h1>
        <div class="filter-container">
            <select v-model="selectedAuthor" @change="filteredBooks" id="author-filter" class="author-select">
                <option value="">Все авторы</option>
                <option v-for="author in authors" :key="author.id" :value="author.id">
                    {{ author.name }}
                </option>
            </select>
        </div>
        <table v-if="filteredBooks.length > 0" class="book-table">
            <thead>
                <tr>
                    <th>Название книги</th>
                    <th>Авторы</th>
                    <th>Количество</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in filteredBooks" :key="book.id">
                    <td>{{ book.title }}</td>
                    <td>{{ book.authors.map(author => author.name).join(', ') }}</td>
                    <td>{{ book.authors.length }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            books: [],
            authors: [],
            selectedAuthor: "",
            filteredBooks: [],
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            await this.fetchBooks();
            await this.fetchAuthors();
        },
        async fetchBooks() {
            try {
                const response = await axios.get('/books');
                this.books = response.data;
                this.filteredBooks = this.books;
            } catch (error) {
                console.error('Ошибка при загрузке названий книг:', error);
            }
        },
        async fetchAuthors() {
            try {
                const response = await axios.get('/authors');
                this.authors = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке авторов:', error);
            }
        },
    },
    computed: {
        filteredBooks() {
            if (this.selectedAuthor === "") {
                return this.books;
            }
            return this.books.filter(book =>
                book.authors.some(author => author.id === this.selectedAuthor)
            );
        }
    }
};
</script>

<style scoped>
.title {
    text-align: center;
    font-size: 2em;
    margin-bottom: 20px;
}

.catalog {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Arial', sans-serif;
}

.filter-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.author-select {
    padding: 10px;
    font-size: 1em;
    border-radius: 4px;
    border: 1px solid #ccc;
    transition: border-color 0.3s;
}

.author-select:hover {
    border-color: #4CAF50;
}

.book-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.book-table th, .book-table td {
    text-align: left;
    padding: 12px;
    border: 1px solid #ddd;
}

.book-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
}

.book-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.book-table tr:hover {
    background-color: #f1f1f1;
}

select {
    margin-bottom: 20px;
}
</style>
