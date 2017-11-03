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
            <tr v-for="(n, index) in row">
                <td>
                    <select :tabindex="n" :name="'product[' + index + '][design]'">
                        <option value="" selected  hidden>Choose here</option>
                        <option v-for="product in products" :value="product.id">
                            {{product.design}}
                        </option>
                    </select>
                </td>
                <td>
                    <select :tabindex="n + row" :name="'product[' + index + '][style]'">
                        <option value="" selected hidden>Choose here</option> 
                        <option v-for="(style, index) in styles" :value="index">
                            {{style}}
                        </option>
                    </select>
                </td>
                <td>
                    <input :tabindex="n + 2 * row" type="number" value="1" :name="'product[' + index + '][quantity]'">
                </td>
                <td>
                    <SuperInput value="" placeholder="width" :tabindex="n + 3 * row" :name="'product[' + index + '][width]'"></SuperInput>
                </td>
                <td>
                    <SuperInput value="" placeholder="height" :tabindex="n + 4 * row" :name="'product[' + index + '][height]'"></SuperInput>
                </td>
                <td>
                    <input type="number" value="0" :tabindex="n + 5 * row" :name="'product[' + index + '][lite]'">
                </td>
            </tr>
        </table>
        <button class="btn btn-primary" type="button" @click="addRows">+</button>
        <input class="btn btn-primary" type="submit" value="submit" />
    </div>
</template>
<script>
import SuperInput from './SuperInput'
export default {
    data: function() {
        return {
            row: 5,
        }
    },
    components: {
        'SuperInput': SuperInput
    },
    methods: {
        addRows: function() {
            this.row += 5
        }
    },
    props: {
        products: {
            type: Array
        },
        styles: {
            type: Array
        }
    }
}
</script>
