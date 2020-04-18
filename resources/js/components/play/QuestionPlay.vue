<template>
    <div class="question-context mb-4">
        <div>
            <div class="question-statement d-flex flex-column align-items-center">
                <p v-text="questionNumber" style="color: rgba(0, 0, 0, 0.27);"></p>
                <p v-text="data.text" style="color: rgba(0, 0, 0, 0.78);"></p>
                <p v-text="typeHint" style="color: rgba(0, 0, 0, 0.27);"></p>
            </div>
            <div class="question-answers d-flex flex-column">
                <answer-play v-for="(answer, index) in answers" :type="data.type" :id="answer.id"
                             :text="answer.text" @inputEvent="UpdateTextAnswer"
                             :key="index" @clickEvent="UpdateSelectedAnswers">
                </answer-play>
            </div>
        </div>
        <button class="question-validate-button btn btn-primary"
                :class="[isNotReadyToAnswer ? 'disabled-button' : '']"
                @click="ValidateAnswer">Valider</button>
    </div>
</template>

<script>
    export default {
        name: "QuestionPlay",
        props: {
            data: {required: true},
            index: {required: true}
        },

        data() {
            return {
                answers: [],
                isNotReadyToAnswer: true
            }
        },

        computed: {
            questionNumber() {
                return "Question #" + this.index;
            },

            typeHint() {
                return [
                    "Sélectionnez une ou plusieurs réponses :",
                    "Sélectionnez une seule réponse :",
                    "Saisissez votre réponse au clavier :"
                ][this.data.type - 1];
            },
        },

        created() {
            axios.get('/questions/' + this.data.id + '/untaggedAnswers')
            .then(response => {
                this.answers = response.data;
                this.answers.forEach(answer => {
                    answer.selected = false;
                })
            })
            .catch(error => {
                console.log(error, 'Returning empty array.');
                return [];
            })
        },

        methods: {
            forward() {
                this.$emit('answered', this.data.id, this.answers);
            },

            ValidateAnswer() {
                if (!this.isNotReadyToAnswer) this.forward();
            },

            UpdateSelectedAnswers(id, state) {
                this.$set(this.answers.find(answer => {
                    return answer.id === id;
                }), 'selected', state);

                // if (this.data.type === 2) {
                //     this.answers.forEach(answer => {
                //         if (answer.id !== id) {
                //             answer.selected = false;
                //         }
                //     });
                // }

                this.SetQuestionState();
            },

            UpdateTextAnswer(id, text) {
                this.$set(this.answers.find(answer => {
                    return answer.id === id;
                }), 'user_guess', text);

                this.SetQuestionState();
            },

            SetQuestionState() {
                this.isNotReadyToAnswer = true;

                if (this.data.type === 3 && this.answers[0].user_guess !== "") {
                    this.isNotReadyToAnswer = false;
                }
                // just in case
                else if (this.data.type === 2 && this.answers.filter(ans => {return ans.selected === true}).length === 1) {
                    this.isNotReadyToAnswer = false;
                }
                else if (this.data.type === 1 && this.answers.some(ans => {return ans.selected === true})) {
                    this.isNotReadyToAnswer = false;
                }
            }
        }
    }
</script>

<style scoped>

    .question-validate-button {
        width: 300px;
        min-height: 50px;
        margin: 30px auto 0;
    }

    .question-statement > p {
        font-size: x-large;
    }

    .question-context {
        display: flex;
        flex-flow: column;
        padding: 50px;
        width: 100%;
        height: 100%;
        justify-content: space-between;
        animation: appear;
        animation-duration: 1s;
        animation-fill-mode: forwards;
        overflow: auto;
    }

    .disabled-button {
        background-color: rgba(196,196,196,0.99) !important;
        cursor: default;
    }

    .disable-button:focus {
        background-color: rgba(196,196,196,0.99) !important;
    }

    .disable-button:active {
        background-color: rgba(196,196,196,0.99) !important;
    }

    @keyframes appear {
        from {
            opacity: 0;
        }
        to {
            opacity: 100%;
        }
    }
</style>
