<template>
<div ref="container">
    <select ref="select" v-model="select" :name="name" :tabindex="tabindex">
        <option value=""></option>
        <option v-for="(value, index) in resource" :key="index" :value="value[valuePath]">{{value[displayPath]}}</option>
    </select>
    </div>
</template>

<script>
import '../vendor/select2.js';
import '../vendor/select2.min.css';
export default {
    mounted: function() {
        const that = this
        const input = $(this.$refs.select)
        const container = $(this.$refs.container)
        input.select2({
            placeholder: 'Choose A Product'
        })
        $('.select2-selection', container).on('keypress', function(e) {
            if (e.keyCode === 13) {
                that.$emit('enter', that.select)
                e.preventDefault();
                // return false;
            }
        });

        $(input).on('select2:select', function(e) {
            that.select = e.params.data.id
            that.$emit('change', that.select)
        })
    },
    data: function() {
        return {
            select: this.value
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
        valuePath: {
            type: String
        },
        displayPath: {
            type: String
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
            $('.select2-selection', $(this.$refs.container)).focus();
        },
    }

}
</script>
<style scoped>

</style>
