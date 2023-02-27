<template>
    <div>
        <label :for="code" v-if="label" :class="labelClass">
            {{ label }}
        </label>
        <input
            :id="code"
            :type="type"
            :name="code"
            :value="value"
            :disabled="disabled"
            :required="required"
            :placeholder="placeholder"
            :class="{
                'form-control ': true,
                'is-invalid': form.errors.has(code),
                ...extraClass,
            }"
            v-model="form[code]"
            v-bind="options"
        />
        <has-error v-if="showError" :form="form" :field="code" />
    </div>
</template>
<script>
export default {
    name: "VField",
    props: {
        showError: {
            type: Boolean,
            default: true,
        },
        code: {
            type: String,
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        labelClass: {
            type: String,
            default: null,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        type: {
            type: String,
            default: "text",
        },
        value: {
            default: null,
        },
        options: {
            type: Object,
            default: () => new Object(),
        },
        extraClass: {
            type: Object,
            default: () => new Object(),
        },
        placeholder: {
            type: String,
        },
        form: {
            type: Object,
            default: () => new Object(),
        },
        required: {
            type: Boolean,
            default: false,
        },
    },
    async mounted() {},
};
</script>
