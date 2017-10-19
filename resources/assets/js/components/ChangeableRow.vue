<template>
    <tr>
        <td>{{product.design}}</td>
        <td v-for="n in 7" v-on:dblclick="changeMode(n - 1, product['price_' + (n - 1)])" >
            <div v-if="mode !== n - 1">    
                {{product['price_' + (n - 1)]}}
            </div>
            <div v-else>
                <input class="input-update" v-model.number="tempValue" type="text" @blur="updateValue(n - 1)" ref="input"/>
            </div>
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
    export default {
        data: function() {
            return {
                mode: -1, //false: show true:change
                tempValue: 0,
                defaultValue: 0
            }
        },
        updated: function() {
            if (this.mode !== -1) {
                this.$refs.input[0].focus()
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
            }
        }
    }
</script>

<style scoped>
    .input-update {
        width: 6rem;
    }
</style>