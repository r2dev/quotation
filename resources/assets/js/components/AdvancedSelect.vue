<template>
<div ref="container">
    <select ref="select" v-model="select" :name="name">
        <option value="" selected hidden>Choose here</option>
        <option v-for="(value, index) in resource" :key="index" :value="value.id">{{value.design}}</option>
    </select>
    </div>
</template>

<script>
import '../vendor/select2.js';
import '../vendor/select2.min.css';
export default {
    created: function() {
        this.preventDropdown = false
    },
    mounted: function() {
        const that = this
        const input = $(this.$refs.select)
        const container = $(this.$refs.container)
        input.select2()
        // console.log($('.select2-selection', $(this.$refs.container)))
        $('.select2-selection', container).on('keypress', function(e) {
            if (e.keyCode === 13) {
                that.$emit('enter')
                e.preventDefault();
                // return false;
            }
        });
    },
    data: function() {
        return {
            select: ''
        }
    },
    beforeDestroy: function() {
        $(this.$refs.select).select2('destroy')
    },
    props: {
        resource: {
            type: Array,
            default: function() { return []; }
        },
        tabindex: {
            type: Number,
            default: -1
        },
        value: {
            type: String,
            default: ''
        },
        name: {
            type: String,
            default: ''
        }
    },
    methods: {
        focus: function() {
            $('.select2-selection').focus();
        },
        handleEnter: function() {
            this.$emit('enter')
        },
    }

}
</script>
<style scoped>

</style>
