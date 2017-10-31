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
            <tr v-for="n in row">
                <td>
                    <select :tabindex="n" name="designs[]">
                        <option v-for="product in products" :value="product.value">
                            {{product.design}}
                        </option>
                    </select>
                </td>
                <td>
                    <select :tabindex="n + row">
                        <option v-for="style in styles">
                            {{style}}
                        </option>
                    </select>
                </td>
                <td>
                    <input :tabindex="n + 2 * row" type="number" value="1">
                </td>
                <td>
                    <SuperInput value="" name="width" placeholder="width" :tabindex="n + 3 * row"></SuperInput>
                </td>
                <td>
                    <SuperInput value="" name="width" placeholder="width" :tabindex="n + 4 * row"></SuperInput>
                </td>
                <td>
                    <input type="number" value="1" :tabindex="n + 5 * row">
                </td>
            </tr>
        </table>
        <button type="button" @click="addRows">+</button>
        <input type="submit" value="submit" />
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
            type: Object
        },
        styles: {
            type: Object
        }
    }
}
</script>
