<style scoped>
form {
    display: inline-block;
}
</style>
<template>
    <div>
        <header class="header">
            <!-- menu option icon -->
            <div class="row mb-2">
                <div class="search">
                    <div class="input-group col-md-12">
                        <input
                            class="form-control"
                            v-model="search"
                            type="search"
                            :placeholder="'Search Books'"
                            id="search-input"
                            @keyup.enter="enterClicked"
                        />
                        <span class="input-group-append">
                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                @click="enterClicked"
                            >
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </header>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Isbn</th>
                    <th scope="col">Published</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="bookData.total > 0">
                    <tr v-for="(book, index) in bookData.data" :key="index">
                        <td>{{ pageCount + index + 1 }}</td>
                        <td>{{ book.title }}</td>
                        <td>{{ book.slug }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.genre }}</td>
                        <td>{{ book.isbn }}</td>
                        <td>{{ dateFormat(book.published) }}</td>
                        <td>{{ book.publisher }}</td>
                        <td>
                            <a
                                v-bind:href="
                                    editBook
                                        .replace(':bookid', book.id)
                                        .replace(
                                            ':page',
                                            'page=' + bookData.current_page
                                        )
                                        .replace(
                                            ':searchText',
                                            'search=' + search
                                        )
                                "
                                class="btn btn-sm btn-primary mr-1"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a>
                                <form @submit.prevent="deleteConfim(book.id)">
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </a>
                        </td>
                    </tr>
                </template>
                <template v-else-if="loading > 0">
                    <tr>
                        <td colspan="8">
                            <v-loading />
                        </td>
                    </tr>
                </template>
                <template v-else-if="bookData.total == 0">
                    <tr>
                        <td colspan="8">No Book Found.</td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="d-flex justify-content-center pagin-bx mt-5">
            <Bootstrap5Pagination
                class="mb-0"
                :data="bookData"
                :limit="1"
                @pagination-change-page="getResults"
            />
        </div>
    </div>
</template>

<script>
import { Bootstrap5Pagination } from "laravel-vue-pagination";
export default {
    components: {
        Bootstrap5Pagination,
    },
    props: ["booksList", "pageNumber", "searchWord", "editBook", "removeBook"],
    data() {
        return {
            bookData: {},
            pageCount: null,
            search: "",
            loading: 0,
        };
    },
    mounted() {},
    created() {
        if (this.searchWord) this.search = this.searchWord;
        this.getResults(this.pageNumber);
    },
    methods: {
        enterClicked() {
            this.getResults();
        },
        getResults(page) {
            this.loading++;
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get(this.booksList + "?page=" + page, {
                    params: { search: this.search },
                })
                .then((res) => {
                    this.bookData = res.data;
                    this.pageCount =
                        res.data.per_page * (res.data.current_page - 1);
                    this.loading--;
                })
                .catch((err) => {
                    console.log(err);
                    this.loading--;
                });
        },
        deleteConfim(bookID) {
            if (!confirm("Do you really want to Archive?")) {
                return false;
            }
            window.location = this.removeBook.replace(":bookid", bookID);
        },
    },
};
</script>
