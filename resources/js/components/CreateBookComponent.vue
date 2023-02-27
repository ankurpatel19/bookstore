<template>
    <book-form-component
        button-text="Create"
        :form="form"
        @finished="addBook"
    ></book-form-component>
</template>
<script>
import BookFormComponent from "./sub-components/BookFormComponent.vue";
import Form from "vform";
export default {
    components: { BookFormComponent },
    props: ["booksList", "storeBook"],
    data() {
        return {
            form: new Form({
                title: "Ankur New Test",
                author: "Ankur patel",
                genre: "456798521",
                description: "This is dummy description",
                isbn: "789465210",
                published: "1997-05-22",
                publisher: "BR Patel",
            }),
            loading: 0,
        };
    },
    created() {
        //this.form.title = "Dynamic pass";
    },
    methods: {
        async addBook() {
            await this.form.post(this.storeBook).then((res) => {
                if (res.data.status && res.data.status === "Success")
                    window.location.href = res.data.redirect;
            });
        },
    },
};
</script>
