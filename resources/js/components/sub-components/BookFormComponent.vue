<template>
    <form>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'title'"
                        :label="'Title'"
                        :placeholder="'Enter Book Title'"
                        :form="form"
                        :options="{ maxlength: 191 }"
                    />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'author'"
                        :label="'Author'"
                        :placeholder="'Enter Author Name'"
                        :form="form"
                        :options="{ maxlength: 50 }"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'genre'"
                        :label="'Genre'"
                        :placeholder="'Enter Genre'"
                        :form="form"
                        :options="{ maxlength: 25 }"
                    />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'isbn'"
                        :label="'Isbn'"
                        :placeholder="'Enter Isbn'"
                        :form="form"
                        :options="{ maxlength: 30 }"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'published'"
                        :label="'Published'"
                        :placeholder="'Enter Published Date'"
                        :form="form"
                        :options="{ maxlength: 50 }"
                    />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <v-field
                        :code="'publisher'"
                        :label="'Publisher'"
                        :placeholder="'Enter Publisher Name'"
                        :form="form"
                        :options="{ maxlength: 50 }"
                    />
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        placeholder="Enter Description"
                        v-model="form['description']"
                    />
                    <has-error :form="form" :field="'description'" />
                </div>
            </div>
        </div>
        <div class="row">
            <v-button
                :disabled="form.busy"
                :value="buttonText"
                @click="$emit('finished')"
            ></v-button>
            <a href="/books" class="btn btn-default float-right">Cancel</a>
        </div>
    </form>
</template>
<script>
export default {
    props: {
        buttonText: {
            type: String,
            default: "Create",
        },
        form: {
            type: Object,
            default: () => new Object(),
        },
    },
    created() {},
    methods: {},
};
</script>
