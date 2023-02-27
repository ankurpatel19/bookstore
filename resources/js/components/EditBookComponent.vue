<template>
    <book-form-component
        button-text="Update"
        :form="form"
        @finished="updateBook"
    ></book-form-component>
</template>
<script>
import BookFormComponent from "./sub-components/BookFormComponent.vue";
import Form from "vform";
export default {
    components: { BookFormComponent },
    props: ["booksList", "showBook"],
    data() {
        return {
            form: new Form({
                title: null,
                author: null,
                genre: null,
                description: null,
                isbn: null,
                published: null,
                publisher: null,
            }),
            loading: 0,
            bookData: {},
        };
    },
    mounted() {
        this.getBookData();
    },
    methods: {
        async getBookData() {
            this.loading++;
            try {
                const { data } = await axios.get(this.showBook);

                this.bookData = data.data;
                this.form.title = this.bookData.title;
                this.form.author = this.bookData.author;
                this.form.genre = this.bookData.genre;
                this.form.description = this.bookData.description;
                this.form.isbn = this.bookData.isbn;
                this.form.published = this.bookData.published;
                this.form.publisher = this.bookData.publisher;
                return data;
            } catch (err) {
                console.log(err);
            } finally {
                this.loading--;
            }
        },
        async updateBook() {
            console.log("Ankur Edit");
        },
    },
};
</script>
