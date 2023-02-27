<template>
    <div>
        <button
            :type="type"
            :class="{
                'btn btn-primary mr-1': true,
                ...extraClass,
            }"
            :disabled="disabled"
        >
            {{ value }}
        </button>
    </div>
</template>
<script>
export default {
    name: "VButton",
    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
        type: {
            type: String,
            default: "button",
        },
        extraClass: {
            type: Object,
            default: () => new Object(),
        },
        value: {
            type: String,
        },
    },
};
</script>
