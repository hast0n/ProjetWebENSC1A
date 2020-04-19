<template>
    <div>
        <div v-if="type !== 3" class="answer-context select-answer my-2 d-flex justify-content-between align-items-center"
             :class="[isSelected ? 'active' : '']" @click="raiseSelectEvent">
            <p v-text="text" class="noselect"></p>
            <p v-if="isSelected" class="selected noselect" >Sélectionnée</p>
        </div>
        <div v-if="type === 3" class="answer-context text-answer">
            <textarea rows="7" class="answer-input" @input="$emit('inputEvent', id, textAnswer)" placeholder="Saisissez la réponse..." v-model="textAnswer"></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AnswerPlay",
        props: {
            text: {required: true},
            id: {required: true},
            type: {required: false}
        },

        data() {
            return {
                isSelected: false,
                textAnswer: ""
            }
        },

        methods: {
            raiseSelectEvent() {
                this.isSelected = !this.isSelected;
                this.$emit('clickEvent', this.id, this.isSelected)
            },
        }
    }
</script>

<style scoped>
    .selected {
        font-size: 1.2em;
        color: rgba(209,209,209,0.99)
    }

    p {
        margin: 0 5px;
        color: rgba(0,0,0,0.47);
        font-size: 1.5rem;
        text-align: justify;
        overflow: hidden;
    }

    .answer-context {
        cursor: pointer;
        display: flex;
        padding: 15px;
        justify-items: center;
    }

    .select-answer {
        border-radius: 10px;
        background-color: rgba(0,0,0,0.02);
        box-shadow: 6px 6px 0.5rem 0.01rem rgba(0, 0, 0, 0.075) !important;
        transition: box-shadow 0.1s ease-in-out
    }

    .text-answer {
        box-shadow: none;
        background-color: transparent;
    }

    .answer-input {
        border: none;
        font-size: 1.5em;
        width: 100%;
        resize: none;
    }

    .answer-input::placeholder {
        color: rgba(0,0,0,0.27);
    }

    .answer-input:focus {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none !important;
    }

    .active {
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.075) !important;
        background-color: rgba(0,0,0,0.05);
    }
</style>
