<template>
    <tr>
        <td v-on:dblclick="changeDesignMode">
            <div v-if="!designMode">
                {{product.design}}
            </div>
            <div v-else>
                <input v-model.trim="tempDesignValue" type="text" @blur="updateDesign" ref="design" />
            </div>
        </td>
        <td v-for="n in size" v-on:dblclick="changeMode(n - 1, product['price_' + (n - 1)])">
            <div v-if="mode !== n - 1">
                {{product['price_' + (n - 1)]}}
            </div>
            <div v-else>
                <input class="input-update" v-model.number="tempValue" type="text" @blur="updateValue(n - 1)" ref="input" />
            </div>
        </td>
        <td>
            <input type="checkbox" :checked="product['frame']">
        </td>
        <td>
            <input type="checkbox" :checked="product['df']">

        </td>
        <td v-on:dblclick="changeRuleMode">
            <div v-if="!ruleMode">
                {{product['rule']}}
            </div>
            <SuperInput v-else ref="rule" :value="defaultRuleValue" @blur="updateRule" />
        </td>
        <td v-on:dblclick="changeProfileMode">
            <div v-if="!profileMode">
                {{product['profile_size']}}
            </div>
            <SuperInput v-else ref="profile" :value="defaultProfileValue" @blur="updateProfile" />
        </td>

        <td>
            <form :action="del" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" :value="token">
                <input type="submit" value="delete">
            </form>
        </td>
    </tr>
</template>
<script>
import axios from 'axios';
import SuperInput from './SuperInput'
import math from 'mathjs'
export default {
    data: function() {
        return {
            mode: -1, //-1: show other:change,
            designMode: false, // false: show true: change
            tempValue: 0,
            defaultValue: 0,
            tempDesignValue: '',
            defaultDesignValue: '',
            ruleMode: false,
            defaultRuleValue: '',
            profileMode: false,
            defaultProfileValue: '',
        }
    },
    components: {
        'SuperInput': SuperInput
    },
    updated: function() {
        if (this.mode !== -1) {
            this.$refs.input[0].focus()
        }
        if (this.designMode) {
            this.$refs.design.focus()
        }
        if (this.ruleMode) {
            this.$refs.rule.focus()
        }
        if (this.profileMode) {
            this.$refs.profile.focus()
        }
    },
    props: {
        product: {
            type: Object
        },
        del: {
            type: String
        },
        token: {
            type: String
        },
        update_url: {
            type: String
        },
        size: {
            type: Number
        }
    },
    methods: {
        changeMode: function(n, value) {
            this.mode = n
            this.tempValue = value
            this.defaultValue = value
        },
        updateValue: function(index) {
            this.mode = -1
            this.product['price_' + index] = this.tempValue
            const that = this;
            if (this.tempValue !== this.defaultValue) {
                axios.put(that.update_url, {
                    value: that.tempValue,
                    index: index
                })
                    .then(function(response) {

                    })
                    .catch(function() {
                        that.product['price_' + index] = that.defaultValue
                    })
            }
        },
        changeDesignMode: function() {
            this.designMode = true
            this.tempDesignValue = this.product['design']
            this.defaultDesignValue = this.product['design']
        },
        updateDesign: function() {
            this.designMode = false
            this.product['design'] = this.tempDesignValue
            const that = this
            if (this.tempDesignValue !== this.defaultDesignValue) {
                axios.put(that.update_url, {
                    value: that.tempDesignValue,
                    index: -2
                })
                    .then(function(response) {

                    })
                    .catch(function() {
                        that.product['design'] = that.defaultDesignValue
                    })
            }
        },
        changeRuleMode: function() {
            this.ruleMode = true
            this.defaultRuleValue = this.product['rule']
        },
        updateRule: function(trueValue) {
            this.ruleMode = false
            const that = this
            if (!math.equal(math.eval(this.defaultRuleValue), math.eval(trueValue))) {
                this.product['rule'] = trueValue
                axios.put(that.update_url, {
                    value: trueValue,
                    index: -3
                })
                    .then(function(response) {
                    })
                    .catch(function() {
                        that.product['rule'] = that.defaultRuleValue
                    })
            }
        },
        changeProfileMode: function() {
            this.profileMode = true
            this.defaultProfileValue = this.product['profile_size']
        },
        updateProfile: function(trueValue) {
            this.profileMode = false
            const that = this
            if (!math.equal(math.eval(this.defaultProfileValue), math.eval(trueValue))) {
                this.product['profile_size'] = trueValue
                axios.put(that.update_url, {
                    value: trueValue,
                    index: -4
                })
                    .then(function(response) {
                    })
                    .catch(function() {
                        that.product['profile_size'] = that.defaultRuleValue
                    })
            }
        }
    }
}
</script>

<style scoped>
.input-update {
    width: 6rem;
}
</style>