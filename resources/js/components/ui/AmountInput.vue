<template>
    <currency-input :value="value"
                    :placeholder="placeholder"
                    :required="required"
                    :disabled="disabled"
                    :precision="precision"
                    :value-range="{min, max}"
                    :allow-negative="false"
                    :currency="currency"
                    class="form-control"
                    @focusin="focused = true"
                    @focusout="focused = false"
                    @input="inputHandler"/>
</template>

<script>
    import {CurrencyInput} from 'vue-currency-input';

    export default {
        name: 'AmountInput',
        components: {CurrencyInput},
        props: {
            value: {
                required: true
            },
            min: {
                type: Number,
                default: 0
            },
            max: {
                type: Number,
                default: 999999999999999
            },
            precision: {
                type: Number,
                default: 8
            },
            placeholder: {
                type: String,
                default: ''
            },
            required: {
                type: Boolean,
                default: true
            },
            disabled: {
                type: Boolean,
                default: false
            },
            suffix: {
                type: String,
                default: null
            }
        },
        data: () => ({
            focused: false
        }),
        computed: {
            currency() {
                if (!this.suffix) return null;

                return {suffix: ' ' + this.suffix.trim()};
            }
        },
        methods: {
            inputHandler(value) {
                if (!this.focused) return;

                this.$emit('input', value);
            }
        }
    }
</script>
