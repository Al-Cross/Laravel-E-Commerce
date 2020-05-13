<template>
    <div>
        <div class="form-group" v-for="input in inputs" v-html="input"></div>
        <button type="button" class="btn btn-primary btn-block" @click="add">Add Attribute</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inputs: []
            };
        },
        methods: {
            add() {
                let field = `<label for="attribute">Attribute</label>
                                <input type="text" class="form-control" name="attribute[]">
                            <div v-if="response.error">
                                <span class="invalid-feedback" role="alert">
                                        <strong v-text="response.error.message"></strong>
                                    </span>
                            </div>
                                `;

                this.inputs.push(field);
            }
        }
    };
</script>
