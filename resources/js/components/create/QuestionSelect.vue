<template>
    <div class="select-item">
        <div class="header">
            <div class="type-info">
                <button type="button" class="dropdown-toggle shadow-none" @click="toggleExpand">
                    <span class="caret"></span>
                </button>
                <p class="text" v-text="question.text" :title="question.text"></p>
            </div>
            <div class="right-side">
                <p class="type" v-text="Type"></p>
                <p class="close" v-if="!showToggle" @click="forward(false)">x</p>
                <toggler v-if="showToggle" :value="selected" @toggle="forward"></toggler>
            </div>
        </div>
        <div class="answers-list" v-if="expand">
            <div class="answers-list-item" v-for="answer in question.answers" :key="answer.id">
                <div v-if="question.type !== 3" :class="[answer.is_right_answer ? 'green-dot' : 'red-dot']"></div>
                <p v-if="question.type === 3" class="text-answer">Bonne réponse :<p>

                <p v-text="answer.text" :title="answer.text"></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            question: {required: true},
            showToggle: {default: true},
        },
        name: "question-select",
        data() {
            return {
                expand: false,
                showAnswers: [],
            }
        },
        computed: {
            Type() {
                return [
                    "Sélection multiple",
                    "Sélection unique",
                    "Zone de texte"
                ][this.question.type - 1];
            },
            selected() {
                return this.question.selected ?? false;
            }
        },

        methods: {
            toggleExpand() {
                this.expand = !this.expand;
            },

            forward(state) {
                this.$emit('selected', this.question.id, state)
            }
        }
    }
</script>

<style scoped>
    .right-side {
        display: flex;
        align-items: center;
    }

    p.close {
        margin-bottom: 2px;
        margin-right: 10px;
        cursor: pointer;
    }

    div.green-dot, div.red-dot {
        height: 10px;
        width: 10px;
        margin-right: 10px;
        border-radius: 10px;
    }

    div.green-dot {
        background-color: rgba(42, 144, 85, 0.63);
    }

    div.red-dot {
        background-color: rgba(224, 46, 46, 0.64);
    }


    .answers-list-item {
        display: flex;
        margin-left: 30px;
        align-items: center;
    }

    .answers-list {
        padding-bottom: 10px;
    }

    .answers-list-item > p {
        margin: 0 10px 0 0;
    }

    .text-answer {
        font-style: italic;
        color: rgba(0,0,0,0.64);
    }

    .dropdown-toggle {
        border: none;
        background-color: transparent;
        color: #b9bbbe;
        outline: none;
        box-shadow: none;
    }

    .select-item {
        display: flex;
        flex-flow: column;
        width: 100%;
        min-height: 50px;
        padding: 0 7px;
        background-color: rgba(0, 0, 0, 0.03);
        border-radius: 20px;
        overflow: hidden;
    }

    .type-info {
        width: auto;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        overflow: hidden;
    }

    .header {
        width: 100%;
        display: flex;
        margin: 8px 0 4px;
        align-items: center;
        justify-content: space-between;
    }

    .type {
        color: rgba(0,0,0,0.25);
        margin: 0 10px;
        white-space: nowrap;
    }

    .text {
        margin: 0 10px;
        width: auto;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
