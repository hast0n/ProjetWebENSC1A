<template>
    <div class="answer-create">
        <p>{{ listIndex + 1 }}</p>

        <input class="form-control" type="text" v-model="text"
               @input="fireUpdate" placeholder="Saisissez une réponse...">

        <toggler :value="obj.status" @toggle="fireUpdate" ref="toggler"></toggler>

        <button type="button" class="btn" @click="fireRemove">Supprimer</button>
    </div>
</template>

<script>
    export default {

        props: {
            obj: {required: true},
            listIndex: {required: true}
        },

        data: function () {
            return {
                text: this.obj.text ?? "",
                status: this.obj.status
            }
        },

        methods: {
            fireUpdate() {
                this.status = this.$refs.toggler.state;
                this.$emit('updateAnswer', [
                        this.obj.id,
                        this.text,
                        this.$refs.toggler.state
                    ]
                )
            },
            fireRemove() {
                this.$emit('removeAnswer', this.obj.id)
            },
            changeState() {
            }
        }
    }
</script>

<style scoped>

    .answer-create {
        margin: 10px;
        padding: 5px 10px;
        align-items: center;
        display: flex;
        border-radius: 7px;
        transition: background-color 0.3s ease-out;
        background-color: white;
        box-shadow: rgba(1,1,1,0.12) 2px 2px 7px;
    }

    button {
        border: none; /*1px solid rgba(128, 128, 128, 0.36);*/
        margin-left: 10px;
    }

    button:hover {
        color: rgba(0,0,0,0.36)
    }

    div.answer-create > p {
        padding-right: 10px;
        font-size: x-large;
        align-self: center;
        margin: 0;
        color: rgba(1, 1, 1, 0.31);
    }

    div.answer-create > input {
        background-color: transparent;
        border: none;
        -webkit-box-shadow: none;
    }
</style>
