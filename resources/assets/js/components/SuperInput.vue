<template>
    <span>
        <input type="text"
               v-model="message" :placeholder="placeholder"
               :tabindex="tabindex" @blur="handleBlur"
               @keydown.enter.prevent="handleEnter" ref="input"
               class="form-control"
               @focus="$event.target.select()"
        >
        <input type="hidden" :value="trueValue" :name="name">
    </span>
</template>

<script>
import math from 'mathjs'
export default {
    data: function() {
        return {
            message: this.value,
            initial: true,
        }
    },
    mounted: function() {
        this.first = false
    },
    props: {
        value: {
            type: String,
            default: ''
        },
        name: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        tabindex: {
            type: Number,
            default: -1
        }
    },
    methods: {
        handleBlur: function() {
            this.$emit('blur', this.trueValue);
        },
        handleEnter: function() {
            this.$emit('enter')
        },
        focus: function() {
            this.$refs.input.focus();
        }
    },
    computed: {
        trueValue: function() {
            try {
                var temp = math.fraction(this.message);
                this.error = '';
                if (temp.n === 0) {
                    return 0;
                } else if (Math.floor(temp.n / temp.d) < 1) {

                    return temp.n + '/' + temp.d;
                } else if (temp.d === 1) {
                    return temp.n;
                } else {
                    return Math.floor(temp.n / temp.d) + ' ' + temp.n % temp.d + '/' + temp.d
                }
            } catch (error) {
                return ''
            }
        }
    }
}

</script>
