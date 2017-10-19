<template>
    <tr>
        <td>
            {{design}}
        </td>
        <td v-for="item in values">
            {{item}}
        </td>

        <td>
            <form action="http://quotation.app/products/1" method="POST">
                <input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" :value="csrfToken">
                <input type="submit" value="delete">
            </form>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            values: {
                type: Array,
                default: []
            },
            productId: {
                type: Number,
                required: true
            },
            csrfToken: {
                type: String,
                required: true
            },
            design: {
                type: String,
                required: true
            }
        }
    }
</script>