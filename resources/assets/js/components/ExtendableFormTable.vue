<template>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>
                    Design
                </th>
                <th>
                    Style
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Width
                </th>
                <th>
                    Height
                </th>
                <th>
                    Lite
                </th>
            </tr>
            <tr v-for="(n, index) in row" :key="index">
                <td>
                    <select
                        :tabindex="n + index * 5"
                        :name="'product[' + index + '][design]'"
                        @keyup.enter="handleEnter(index, 0)"
                        :ref="'input_' + index + '_' + 0"
                    >
                        <option value="" selected hidden>Choose here</option>
                        <option v-for="product in products" :value="product.id" :key="product.id">
                            {{product.design}}
                        </option>
                    </select>
                </td>
                <td>
                    <select
                        :tabindex="n + index * 5 + 1"
                        :name="'product[' + index + '][style]'"
                        :ref="'input_' + index + '_' + 1"
                        @keyup.enter="handleEnter(index, 1)"
                        v-model="style_select"
                    >
                        <option value="" selected hidden>Choose here</option>
                        <option v-for="(style, index) in styles" :value="index" :key="index">
                            {{style}}
                        </option>
                    </select>
                </td>
                <td>
                    <input
                        :tabindex="n + index * 5 + 2"
                        type="number" value="1"
                        :name="'product[' + index + '][quantity]'"
                        :ref="'input_' + index + '_' + 2"
                        @keyup.enter="handleEnter(index, 2)"
                    >
                </td>
                <td>
                    <SuperInput
                        value=""
                        placeholder="width"
                        :tabindex="n + index * 5 + 3"
                        :name="'product[' + index + '][width]'"
                        :ref="'input_' + index + '_' + 3"
                        @enter="handleEnter(index, 3)"
                    />
                </td>
                <td>
                    <SuperInput
                        value=""
                        placeholder="height"
                        :tabindex="n + index * 5 + 4"
                        :name="'product[' + index + '][height]'"
                        :ref="'input_' + index + '_' + 4"
                        @enter="handleEnter(index, 4)"
                    />
                </td>
                <td>
                    <input
                        v-if="index === row - 1"
                        type="number"
                        value="0"
                        :tabindex="n + index * 5 + 5"
                        :name="'product[' + index + '][lite]'" :ref="'input_' + index + '_' + 5"
                        @keyup.enter="handleEnter(index, 5)"
                        @keydown.tab.prevent="handleEnter(index, 0)"
                    >    
                    <input
                        v-else
                        type="number"
                        value="0"
                        :tabindex="n + index * 5 + 5"
                        :name="'product[' + index + '][lite]'" :ref="'input_' + index + '_' + 5"
                        @keyup.enter="handleEnter(index, 5)"
                    >
                </td>
            </tr>
        </table>
        <button class="btn btn-primary" type="button" @click="addRows(5)">+</button>
        <input class="btn btn-primary" type="submit" value="submit" />
    </div>
</template>
<script>
import SuperInput from './SuperInput'
export default {
    created: function() {
        this.focusFlag = null
        this.passValue = []
    },
    data: function() {
        return {
            row: 1,
            style_select: ''
        }
    },
    updated: function() {
        if (this.focusFlag) {
            this.$refs[this.focusFlag][0].focus()
            this.focusFlag = null
        }
        if (this.passValue.length === 2) {
            $(this.$refs[`input_${this.passValue[1]}_0`][0]).val(this.passValue[0])
        }
    },
    components: {
        'SuperInput': SuperInput
    },
    methods: {
        handleEnter: function(index, target) {
            if (index === this.row - 1) {
                this.row += 1
                console.log('focus that after render', index + 1, target)
                this.focusFlag = `input_${index+1}_${target}`
                if ($(this.$refs[`input_${index}_0`]).val()) {
                    this.passValue = [$(this.$refs[`input_${index}_0`]).val(), index + 1]
                }
                
            } else {
                //focus that
                console.log('focus that', index + 1, target)
                this.$refs[`input_${index+1}_${target}`][0].focus()
            }
        },
        addRows: function(row) {
            this.row += row
        },
    },
    
    props: {
        products: {
            type: Array
        },
        styles: {
            type: Array
        }
    },
    mounted: function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        })
    }

}
</script>
